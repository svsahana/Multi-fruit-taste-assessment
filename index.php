<?php
session_start();

require_once 'config/connection.php';

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM registration WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) { 
            $_SESSION['isLogin'] = true;
            $_SESSION['username'] = $row['username'];

            echo "<script>alert('Login successful!'); location.href = 'home.php';</script>";
        } else {
            echo "<script>alert('Incorrect password. Please try again.'); location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('No user found with the provided username.'); location.href = 'index.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Multi-Fruit Detection System - Login">
    <meta name="author" content="">
    <title>Multi-Fruit Detection - Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f7f9f0, #c8d6c1);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            background: linear-gradient(135deg, #f7f9f0, #f7f9f0);
            color: #fff;
            text-align: center;
            padding: 30px 20px;
            border-bottom-left-radius: 50% 20%;
            border-bottom-right-radius: 50% 20%;
        }

        .header h2 {
            margin: 0;
            font-size: 2rem;
            color:black;
        }

        .header p {
            margin: 10px 0 0;
            font-size: 15px;
            font-weight: 500;
            color:black;
        }

        .form-container {
            padding: 30px 35px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group input {
            width: 90%;
            padding: 15px 20px;
            border-radius: 10px;
            border: 1px solid #ddd;
            font-size: 16px;
            transition: border-color 0.3s ease;
            display: block;
            margin: 0 auto;
        }

        .form-group input:focus {
            border-color: #f7f9f0;
            outline: none;
            box-shadow: 0 0 5px rgba(255, 154, 158, 0.5);
        }

        .btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #f7f9f0, #f7f9f0);
            border: none;
            border-radius: 10px;
            color: black;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background: linear-gradient(135deg, #fad0c4, #ff9a9e);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(250, 208, 196, 0.4);
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #999;
            background: #f1f1f1;
        }

        .footer a {
            color: #ff9a9e;
            text-decoration: none;
            font-weight: 500;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .warning-icon {
            font-size: 30px;
            color: #ff9a9e;
            margin-bottom: 10px;
        }

        @media (max-width: 480px) {
            .header h2 {
            font-size: 1.5rem;
            }

            .form-container {
            padding: 20px;
            }
        }

        .footer a {
            color: #c8d6c1;
            text-decoration: none;
            font-weight: 500;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .warning-icon {
            font-size: 30px;
            color: #c8d6c1;
            margin-bottom: 10px;
        }

        @media (max-width: 480px) {
            .header h2 {
                font-size: 1.5rem;
            }

            .form-container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="header">
            <i class="fas fa-apple-alt"></i>
            <h2>Multi-Fruit Detection</h2>
            <p>Login to Secure Dashboard</p>
        </div>
        <div class="form-container">
            <form method="POST">
                <div class="form-group">
                    <input type="text" name="username" placeholder="Enter Username" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Enter Password" required>
                </div>
                <div style="text-align: center;">
                    <button type="submit" name="login" class="btn" style="padding: 10px 20px;">Login</button>
                </div>
            </form>
        </div>
        <div class="footer">
            <p>Don't have an account? <a href="registration.php">Sign Up</a></p>
        </div>
    </div>
</body>

</html>
