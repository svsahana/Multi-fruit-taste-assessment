<?php
session_start();

require_once 'config/connection.php';

if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] !== true) {
    header('Location: index.php');
    exit;
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (isset($_POST['change_password'])) {

    $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $username = $_SESSION['username'];

    if ($new_password !== $confirm_password) {
        echo "<script>alert('New password and confirm password do not match.'); location.href = 'change_password.php';</script>";
        exit;
    }

    $query = "SELECT password FROM registration WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($current_password, $row['password'])) {

            if (strlen($new_password) < 8) {
                echo "<script>alert('New password must be at least 8 characters long.'); location.href = 'change_password.php';</script>";
                exit;
            }

            if (!preg_match('/[A-Z]/', $new_password)) {
                echo "<script>alert('New password must contain at least one uppercase letter.'); location.href = 'change_password.php';</script>";
                exit;
            }

            if (!preg_match('/[a-z]/', $new_password)) {
                echo "<script>alert('New password must contain at least one lowercase letter.'); location.href = 'change_password.php';</script>";
                exit;
            }

            if (!preg_match('/[0-9]/', $new_password)) {
                echo "<script>alert('New password must contain at least one number.'); location.href = 'change_password.php';</script>";
                exit;
            }

            if (!preg_match('/[\W]/', $new_password)) {
                echo "<script>alert('New password must contain at least one special character.'); location.href = 'change_password.php';</script>";
                exit;
            }

            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            $update_query = "UPDATE registration SET password = '$hashed_password' WHERE username = '$username'";
            if (mysqli_query($conn, $update_query)) {
                echo "<script>alert('Password updated successfully.'); location.href = 'home.php';</script>";
            } else {
                echo "<script>alert('Failed to update the password. Please try again.'); location.href = 'change_password.php';</script>";
            }
        } else {
            echo "<script>alert('Current password is incorrect.'); location.href = 'change_password.php';</script>";
        }
    } else {
        echo "<script>alert('User not found.'); location.href = 'index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Learn how to detect and prevent phishing attacks">
    <meta name="author" content="">
    <title>Phishing Detection | Change Password</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
<body id="page-top">
    <!-- Navbar Menu  ---->
    <?php include 'include/header.php';?>

    <div class="container py-5">
        <h3 class="title text-center mb-4">Change Password</h3>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <form method="POST" action="change-password.php">
                            <div class="form-group">
                                <label for="current_password">Current Password:</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password:</label>
                                <input type="password" name="new_password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm New Password:</label>
                                <input type="password" name="confirm_password" class="form-control" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="change_password" class="btn btn-primary" style="background-color:rgb(255, 0, 0); border: 1px solid white;">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer ------>
    <?php include 'include/footer.php';?>

    <!--- Smooth Scroll js ---------->
    <script type="text/javascript" src="js/smooth-scroll.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        var scroll = new SmoothScroll('a[href*="#"]');
    </script>
</body>
</html>
