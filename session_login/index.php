<?php
include '../configuration/config.php';
@session_start();
// echo $_SESSION['user_name']
// if (isset($_SESSION['error'])) {
//     echo '<p style="color:white; text-align:center;">' . $_SESSION['error'] . '</p>';
//     unset($_SESSION['error']); // Clear the error after displaying it
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="login_style.css">
    <title>Login Page</title>
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

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 30%;
            margin-top: 20px;
            box-sizing: border-box;
        }

        .card-header {
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        .card-body {
            padding: 10px;
        }

        .textfield {
            width: 100%;
    padding: -5px;
    margin-bottom: 15px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-left: -6px;
        }

        .textfield:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: -1px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .forgetpas {
            margin-top: 10px;
            text-align: right;
        }

        .forgetpas a {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .forgetpas a:hover {
            text-decoration: underline;
        }

        /* .logo {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
        } */


.logo {
    width: 100px;
    height: auto;
    margin-bottom: 10px;
    display: block;
    margin-left: auto;
    margin-right: auto;
}

        .title {
            font-size: 1.5rem;
            color: #333;
            margin: 0;
            text-align: center;
        }

        @media (max-width: 600px) {
            .center {
                padding: 30px;
            }

            .logo {
                width: 40px;
            }

            .title {
                font-size: 1.6rem;
            }
        }
    </style>
</head>
<body>
  
        
            <!-- <img src="assets/images/logo/crop_logo.jpg" alt="Logo" class="logo">
            <h2 class="title">Farmer Mart</h2> -->
       

        <div class="card">
        <img src="assets/images/logo/crop_logo.jpg" alt="Logo" class="logo">
        <h2 class="title">Farmer Mart</h2>
            <div class="card-body">
                <form action="login_create.php" method="POST">
                    <input type="text" name="username" id="username" class="textfield" placeholder="username" required><br>
                    <input type="password" name="password" id="password" class="textfield" placeholder="password" required><br>

                    <div class="forgetpas">
                        <a href="forget_password.php" class="link">Forget Password?</a>
                    </div>
                    <!-- <input type="submit" name="login" value="Login" class="btn"> -->
                     <button type="submit">Login</button>
                </form>
            </div>
        </div>
   
</body>
</html>
