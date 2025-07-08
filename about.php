<?php
session_start();

if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] !== true) {
    header('Location: index.php');
    exit;
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$username = $_SESSION['username']; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="About Multi-Fruit Detection System">
    <meta name="keywords" content="Fruit Detection, Multi-Fruit, About Us, Agriculture Technology">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About Us | Multi-Fruit Detection System</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <style>
        .hero__text__title span {
            background: rgba(0, 0, 0, 0.5);
            padding: 10px;
            border-radius: 5px;
        }

        .hero__text p {
            margin-top: 20px;
            color: #ffffff;
        }
        .feature__item {
            margin-bottom: 20px;
        }
        .cta {
            padding: 50px 0;
            background: #f7f7f7;
        }
        .cta h4 {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <!-- Page Preloader -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section -->
    <?php include 'include/header.php'; ?>
    
    <!-- About Section -->
    <section class="service spad set-bg" data-setbg="img/about.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero__text text-center">
                        <div class="hero__text__title">
                            <span>ABOUT US</span>
                            <h2 style="color:rgb(0, 0, 0);">Your Partner in Agricultural Technology</h2>
                        </div>
                        <p style="color: grey;">We are dedicated to enhancing agricultural efficiency through advanced multi-fruit detection solutions, 
                           including fruit classification, quality control, and yield optimization.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Mission Section -->
    <section class="service spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <span>Our Mission</span>
                        <h2>Improving Agriculture through Technology</h2>
                        <p>Our goal is to create more efficient and productive agricultural practices by leveraging state-of-the-art technology 
                           and providing data-driven insights.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <span>Features</span>
                        <h2>Why Choose Our Multi-Fruit Detection System?</h2>
                        <p>Discover the key features that make our system the best choice for fruit detection and analysis.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card feature__item text-center">
                        <div class="card-body">
                            <h6 class="card-title">High Accuracy</h6>
                            <p class="card-text">Our system boasts a 99.2% accuracy rate in detecting and classifying multiple fruit varieties.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card feature__item text-center">
                        <div class="card-body">
                            <h6 class="card-title">Real-Time Analysis</h6>
                            <p class="card-text">Get instant results with our real-time analysis feature, ensuring optimal sorting and quality control.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card feature__item text-center">
                        <div class="card-body">
                            <h6 class="card-title">Scalability</h6>
                            <p class="card-text">Our system is designed to scale with your needs, from small farms to large agricultural operations.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <div class="cta text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4>Ready to Work Together?</h4>
                    <p>Contact us today to learn more about our solutions and how we can assist you in improving agricultural efficiency.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <?php include 'include/footer.php'; ?>

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
