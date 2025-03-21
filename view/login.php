<?php
include('../configuration/config.php');
if(isset($_SESSION['IS_LOGIN'])){
	// header('location:index.php');
    echo "<script>window.location.href='../view/index.php';</script>";
	die();
}
if(isset($_POST['submit'])){
	$username=mysqli_real_escape_string($conn,$_POST['email']);
	$password=mysqli_real_escape_string($conn,$_POST['password']);
	
	$res=mysqli_query($conn,"select * from user where email='$username'");
	
	if(mysqli_num_rows($res)>0){
		$row=mysqli_fetch_assoc($res);
        // echo $password;
        // echo $row['password'];
		$verify=password_verify($password,$row['password']);
		if($verify==1){
			$_SESSION['IS_LOGIN']=true;
			$_SESSION['UNAME']=$row['email'];
            $_SESSION['password']=$row['password'];
			header('location:index.php');
			die();
		}else{
            echo "<script>
                alert('Please enter correct password.');
            </script>";

		}
	}else{
        echo "<script>
                alert('Please enter correct username.');
            </script>";
	}
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center; / Center all content /
        }

        .logo {
            width: 120px; / Set width of the logo /
            height: 120px; / Set height of the logo /
            margin-bottom: 20px; / Space between logo and login heading /
            display: block; / Ensures the logo is centered /
            margin-left: auto;
            margin-right: auto;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: bold;
        }

        table {
            width: 100%;
        }

        td {
            padding: 10px 0;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px; / Space between input fields /
        }

        / Adding placeholder text /
        input[type="text"]::placeholder,
        input[type="password"]::placeholder {
            color: #aaa;
            font-size: 14px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff; / Blue color for the button /
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3; / Darker blue on hover /
        }

        .link {
            text-align: center;
            margin-top: 20px;
        }

        .link a {
            color: #007bff; / Blue color for the link /
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease, text-decoration 0.3s ease;
        }

        .link a:hover {
            color: #0056b3; / Darker blue on hover /
            text-decoration: underline; / Underline on hover /
        }
    </style>
</head>
<body>

<div class="login-container">
    <!-- Logo with extra class for customization -->
    <img src="../view/assets/images/logo/crop_logo.jpg" alt="Logo" class="logo"> <!-- Replace 'crop_logo.jpg' with your logo's file name -->

    <!-- Centered Login Title -->
    <h1>Farmer Mart</h1>

    <form method="POST">
        <table>
            <tr>
                <td>
                    <input type="text" name="email" placeholder="Enter your username" required/>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="password" name="password" placeholder="Enter your password" required/>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="submit" value="Login" />
                </td>
            </tr>
        </table>
        <div class="link">
            <a href="forget_password.php">Forgot Password?</a>
        </div>
    </form>
</div>

</body>
</html>

