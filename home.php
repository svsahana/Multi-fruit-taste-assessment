<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] !== true) {
    header('Location: index.php');
    exit;
}
$username = $_SESSION['username']; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Multi-Fruit Detection and Analysis System">
    <meta name="keywords" content="Fruit Detection, Quality Analysis, Sorting System, Agriculture AI">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Multi-Fruit Detection & Analysis | System</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    
    <!-- Custom CSS for color palette -->
    <style>
        :root {
            --primary-color: #4e9525;  /* Fresh green */
            --secondary-color: #ff6b35; /* Vibrant orange */
            --accent-color: #8a4fff;    /* Purple accent */
            --light-bg: #f7f9f0;        /* Light background */
            --dark-text: #2a3132;       /* Dark text color */
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark-text);
            background-color: var(--light-bg);
        }
        
        .section-title span {
            color: var(--secondary-color);
        }
        
        .section-title h2 {
            color: var(--primary-color);
        }
        
        .hero {
            background-color: rgba(78, 149, 37, 0.05);
        }
        
        .hero__text__title span {
            color: var(--secondary-color);
            font-weight: 500;
        }
        
        .hero__text__title h2 {
            color: var(--primary-color);
        }
        
        .service__item {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .service__item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .service__item h5 {
            color: var(--primary-color);
            margin-top: 15px;
        }
        
        .feature__item {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.04);
        }
        
        .feature__item h6 {
            color: var(--primary-color);
            font-weight: 500;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #3c7a1a;
            border-color: #3c7a1a;
        }
        
        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-secondary:hover {
            background-color: #e55a29;
            border-color: #e55a29;
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
   
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <?php include 'include/header.php'; ?>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero spad set-bg" data-setbg="img/feature/fruit-banner.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero__text">
                        <div class="hero__text__title">
                            <span style="color: var(--light-bg);">MULTI-FRUIT DETECTION & ANALYSIS</span>
                            <h2 style="color: var(--light-bg);">Advanced AI-Powered Fruit Recognition System</h2>
                        </div>
                        <p class="mt-4" style="color: var(--light-bg);">Cutting-edge detection technology for accurate identification, sorting, and quality assessment of multiple fruit varieties simultaneously</p>
                        <a href="#features" class="btn btn-primary mt-4">Explore Features</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- Empty for banner image background -->
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Services Section Begin -->
    <section class="service spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Smart Detection</span>
                        <h2>Multi-Fruit Recognition System</h2>
                        <p>Our advanced computer vision technology simultaneously detects and analyzes multiple fruit varieties with exceptional accuracy.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="service__item">
                        <img src="img/feature/detection.jpg" alt="Fruit Identification">
                        <h5>Multi-Fruit Identification</h5>
                        <p>Accurately detect and classify multiple fruit varieties simultaneously with 99.2% accuracy rate.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="service__item">
                        <img src="img/feature/quality-analysis.jpg" alt="Quality Analysis">
                        <h5>Quality Analysis</h5>
                        <p>Assess fruit ripeness, size, color, and detect imperfections in real-time for optimal sorting.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="service__item">
                        <img src="img/feature/remote-monitor.jpg" alt="Remote Monitoring">
                        <h5>Remote Monitoring</h5>
                        <p>Monitor the system's performance and fruit quality metrics remotely from any device.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Feature Section Begin -->
    <section id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Features</span>
                        <h2>Why Choose Our Multi-Fruit Detection System?</h2>
                        <p>Discover the key features that make our system the best choice for fruit detection and analysis.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="feature__item">
                        <h6>High Accuracy</h6>
                        <p>Our system boasts a 99.2% accuracy rate in detecting and classifying multiple fruit varieties.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="feature__item">
                        <h6>Real-Time Analysis</h6>
                        <p>Get instant results with our real-time analysis feature, ensuring optimal sorting and quality control.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="feature__item">
                        <h6>Scalability</h6>
                        <p>Our system is designed to scale with your needs, from small farms to large agricultural operations.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Feature Section End -->
    
    <!-- Stats Section Begin -->
    <section class="stats spad" style="background-color: var(--primary-color); color: white;">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <h2>45+</h2>
                    <p>Fruit Varieties Detected</p>
                </div>
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <h2>99.2%</h2>
                    <p>Detection Accuracy</p>
                </div>
                <div class="col-md-3 col-6">
                    <h2>0.3s</h2>
                    <p>Processing Time</p>
                </div>
                <div class="col-md-3 col-6">
                    <h2>24/7</h2>
                    <p>Continuous Operation</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Stats Section End -->

    <?php include 'include/footer.php'; ?>
    
    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>