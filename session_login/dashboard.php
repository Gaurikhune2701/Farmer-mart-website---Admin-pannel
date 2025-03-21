<?php
include '../configuration/config.php';

if(!isset($_SESSION['IS_LOGIN'])){
	header('location:login.php');
	die();
}
echo "Welcome ".$_SESSION['UNAME'];
?>
<br/>
<a href="logout.php">Logout</a>