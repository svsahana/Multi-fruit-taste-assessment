import gradio as gr
import cv2
import numpy as np
from PIL import Image, ImageDraw
from transformers import AutoImageProcessor, AutoModelForImageClassification
import torch
from sklearn.cluster import KMeans
from collections import Counter
import json
import time


processor = AutoImageProcessor.from_pretrained("dima806/fruit_100_types_image_detection")
model = AutoModelForImageClassification.from_pretrained("dima806/fruit_100_types_image_detection")


with open("1.json", "r") as file:
    medical_data = json.load(file)

def detect_fruit(image):
    image_pil = image.convert("RGB")
    inputs = processor(image_pil, return_tensors="pt")
    outputs = model(**inputs)
    predictions = torch.nn.functional.softmax(outputs.logits, dim=-1)
    top_pred = torch.argmax(predictions, dim=-1).item()
    score = predictions[0, top_pred].item()

    fruit_name = model.config.id2label[top_pred]
    return [(fruit_name, [0.1, 0.1, 0.9, 0.9], score)], fruit_name

def draw_boxes(image, detections):
    draw = ImageDraw.Draw(image)
    for fruit_name, box, score in detections:
        x_min, y_min, x_max, y_max = [
            max(0, min(image.width, int(coord * image.width))) if i % 2 == 0
            else max(0, min(image.height, int(coord * image.height)))
            for i, coord in enumerate(box)
        ]
        draw.rectangle([x_min, y_min, x_max, y_max], outline="red", width=3)
        draw.text((x_min, y_min), f"{fruit_name} ({score:.2f})", fill="red")
    return image

def get_dominant_color(image, k=3):
    image = cv2.cvtColor(image, cv2.COLOR_RGB2BGR)
    image = image.reshape((-1, 3))
    kmeans = KMeans(n_clusters=k, random_state=42, n_init=10)
    kmeans.fit(image)
    cluster_centers = kmeans.cluster_centers_
    counts = Counter(kmeans.labels_)
    dominant_color = cluster_centers[max(counts, key=counts.get)]
    return tuple(map(int, dominant_color))

def process_image(image):
    image_np = np.array(image.convert("RGB"))
    image_bgr = cv2.cvtColor(image_np, cv2.COLOR_RGB2BGR)
    hsv = cv2.cvtColor(image_bgr, cv2.COLOR_BGR2HSV)

    lower_green, upper_green = np.array([35, 50, 50]), np.array([85, 255, 255])  # Unripe (Green)
    lower_yellow, upper_yellow = np.array([20, 50, 50]), np.array([40, 255, 255])  # Ripe (Yellow)
    lower_orange, upper_orange = np.array([10, 100, 100]), np.array([30, 255, 255])  # Mid Ripe (Orange)
    lower_red, upper_red = np.array([0, 100, 100]), np.array([10, 255, 255])  # Overripe (Red)
    lower_deep_red, upper_deep_red = np.array([170, 100, 100]), np.array([180, 255, 255])  # Dark Red (Very Overripe)

    greenmask = cv2.inRange(hsv, lower_green, upper_green)
    yellowmask = cv2.inRange(hsv, lower_yellow, upper_yellow)
    orangemask = cv2.inRange(hsv, lower_orange, upper_orange)
    redmask = cv2.inRange(hsv, lower_red, upper_red)
    deepredmask = cv2.inRange(hsv, lower_deep_red, upper_deep_red)

    cnt_g, cnt_y, cnt_o, cnt_r, cnt_dr = np.sum(greenmask == 255), np.sum(yellowmask == 255), \
                                         np.sum(orangemask == 255), np.sum(redmask == 255), \
                                         np.sum(deepredmask == 255)

    tot_area = cnt_g + cnt_y + cnt_o + cnt_r + cnt_dr
    if tot_area == 0:
        return "No fruit detected!", "N/A"

    gperc, yperc, operc, rperc, drperc = cnt_g / tot_area, cnt_y / tot_area, cnt_o / tot_area, cnt_r / tot_area, cnt_dr / tot_area

    if gperc > 0.5:
        return "Unripe 🍏", "Sour 🍋"
    elif yperc > 0.5:
        return "Ripe 🍌", "Sweet 🍓"
    elif operc > 0.5:
        return "Mid Ripe 🍊", "Balanced 🍍"
    elif rperc > 0.5:
        return "Overripe 🍎", "Very Sweet 🍒"
    elif drperc > 0.5:
        return "Extremely Overripe �", "Fermented 🫒"
    else:
        return "Partially Ripe 🥭", "Mixed Taste 🍉"

def fetch_general_info(fruit_name):

    fruit_name_lower = fruit_name.lower()


    if fruit_name_lower in medical_data:
        return medical_data[fruit_name_lower]["medical_details"]
    else:
        return "No medical details found for this fruit."

def analyze_fruit(image):
    image_pil = Image.fromarray(image)
    detected_fruits, fruit_name = detect_fruit(image_pil)

    if detected_fruits:
        processed_image = draw_boxes(image_pil.copy(), detected_fruits)
        results = "\n".join([f"Detected: {name} (Confidence: {score:.2%})" for name, _, score in detected_fruits])
        ripeness, taste = process_image(image_pil)
        dominant_color = get_dominant_color(np.array(image_pil))

        return (
            np.array(processed_image), results, ripeness, taste, f"RGB{dominant_color}", fruit_name
        )
    else:
        return np.array(image_pil), "No fruits detected!", "N/A", "N/A", "N/A", "None"

def get_info_page(fruit_name, image):
    if fruit_name == "None":
        return np.array(image), "<h2 style='font-size: 24px;'>No fruit detected!</h2>"

    general_info = fetch_general_info(fruit_name)
    styled_text = f"<h2 style='font-size: 24px;'>Medical Information about {fruit_name}</h2><p style='font-size: 30px;'>{general_info}</p>"

    return np.array(image), styled_text

def analyze_webcam_image(image):
    if image is None:
        return None, "No image captured!", "N/A", "N/A", "N/A", "None"

    image_pil = Image.fromarray(image)
    detected_fruits, fruit_name = detect_fruit(image_pil)

    if detected_fruits:
        processed_image = draw_boxes(image_pil.copy(), detected_fruits)
        results = "\n".join([f"Detected: {name} (Confidence: {score:.2%})" for name, _, score in detected_fruits])
        ripeness, taste = process_image(image_pil)
        dominant_color = get_dominant_color(np.array(image_pil))

        return (
            np.array(processed_image), results, ripeness, taste, f"RGB{dominant_color}", fruit_name
        )
    else:
        return np.array(image_pil), "No fruits detected!", "N/A", "N/A", "N/A", "None"

def capture_image():
    cap = cv2.VideoCapture(0)
    if not cap.isOpened():
        return None, "Camera not available!", "N/A", "N/A", "N/A", "None"

    start_time = time.time()
    detected = False
    frame_rgb = None
    detected_fruits = []
    fruit_name = "None"

    while time.time() - start_time < 10:
        ret, frame = cap.read()
        if not ret:
            break

        frame_rgb = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
        image_pil = Image.fromarray(frame_rgb)

        detected_fruits, fruit_name = detect_fruit(image_pil)
        if detected_fruits:
            detected = True
            break

    cap.release()

    if detected:
        return frame_rgb
    else:
        return None, "No fruits detected!", "N/A", "N/A", "N/A", "None"

def analyze_webcam():
    captured_image = capture_image()
    if captured_image is None or isinstance(captured_image, tuple):
        return captured_image

    return analyze_webcam_image(captured_image)

with gr.Blocks() as demo:
    gr.Markdown("<h1 style='font-size: 60px;'>🍎 Fruit Detector & Ripeness Analyzer 🍌</h1>")
    gr.Markdown("<h2 style='font-size:30;'>Upload an image to detect fruit type, ripeness level, taste, and dominant color.</h2>")

    with gr.Tabs():
        with gr.Tab("Analyze Image"):
            with gr.Row():
                image_input = gr.Image(type="numpy", label="Upload Image")
                image_output = gr.Image(type="numpy", label="Processed Image")
            with gr.Row():
                results = gr.Textbox(label="Detection Results", lines=3)
                ripeness = gr.Textbox(label="Ripeness Level")
                taste = gr.Textbox(label="Taste")
                dominant_color = gr.Textbox(label="Dominant Color")
                fruit_name = gr.Textbox(label="Detected Fruit", visible=False)
            analyze_button = gr.Button("Analyze Image")
            analyze_button.click(analyze_fruit, inputs=[image_input], outputs=[image_output, results, ripeness, taste, dominant_color, fruit_name])

        with gr.Tab("Fruit Information"):
            with gr.Row():
                image_output_info = gr.Image(type="numpy", label="Uploaded Image", height=500, width=500)
            info_page = gr.Markdown()
            info_button = gr.Button("Fetch Information")
            info_button.click(get_info_page, inputs=[fruit_name, image_input], outputs=[image_output_info, info_page])

        with gr.Tab("Live Camera Input"):
            with gr.Row():
                webcam_output = gr.Image(type="numpy", label="Processed Image")
            with gr.Row():
                webcam_results = gr.Textbox(label="Detection Results", lines=3)
                webcam_ripeness = gr.Textbox(label="Ripeness Level")
                webcam_taste = gr.Textbox(label="Taste")
                webcam_dominant_color = gr.Textbox(label="Dominant Color")
                webcam_fruit_name = gr.Textbox(label="Detected Fruit", visible=False)
            webcam_analyze_button = gr.Button("Live Capture & Analyze")
            webcam_analyze_button.click(analyze_webcam, inputs=[], outputs=[webcam_output, webcam_results, webcam_ripeness, webcam_taste, webcam_dominant_color, webcam_fruit_name])

demo.launch()
