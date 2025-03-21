<?php
@session_start();
include '../configuration/config.php';
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .center {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .center h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .center input[type="email"], .center input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .center input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        .center input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="center">
        <h2>Forgot Your Password?</h2>
        
        <form action="forget_password_verify.php" method="POST">
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
            <input type="submit" name=" submit" value="Reset Password">
        </form>
    </div>
</body>
</html>

