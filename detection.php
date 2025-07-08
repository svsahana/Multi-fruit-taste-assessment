<?php
session_start();

if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] !== true) {
    header('Location: index.php');
    exit;
}

$username = $_SESSION['username']; 
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Traffic Detection System">
    <meta name="keywords" content="Traffic Detection, Vehicle Count, Sign Detection">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detection Page</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">

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
</head>

<body>
    <!-- Header Section Begin -->
    <?php include 'include/header.php'; ?>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero spad set-bg" data-setbg="img/vehicle-counting.jpeg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero__text">
                        <div class="hero__text__title">
                            <span>Detection Systems</span>
                            <h2>Advanced Traffic Solutions</h2>
                        </div>
                        <p style="color: white;">Explore our detection systems for traffic sign recognition and vehicle count analysis.</p>
                    </div>
                </div>
                <div class="col-lg-5"></div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Detection Section Begin -->
    <section class="detection spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <span>Detection Systems</span>
                        <h2>Select Your Option</h2>
                        <p>Our cutting-edge detection solutions enhance road safety and optimize traffic flow.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="cta__item set-bg" data-setbg="img/cta/cta-1.jpg">
                        <h4>Traffic Sign Detection</h4>
                        <p>Accurately detect and classify traffic signs for enhanced road safety.</p>
                        <button class="btn btn-primary mt-3" style="background-color: #d32f2f; border: 1px solid white;" onclick="location.href=''">
                            Explore Traffic Sign Detection
                        </button>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="cta__item set-bg" data-setbg="img/cta/cta-2.jpg">
                        <h4>Vehicle Count Analysis</h4>
                        <p>Monitor and analyze vehicle counts to optimize traffic flow.</p>
                        <button class="btn btn-primary mt-3" style="background-color: #d32f2f; border: 1px solid white;" onclick="location.href=''">
                            Explore Vehicle Count Analysis
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Detection Section End -->

    <!-- Footer Section Begin -->
    <?php include 'include/footer.php'; ?>
    <!-- Footer Section End -->

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
