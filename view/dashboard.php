<?php
include '../configuration/config.php';

if(!isset($_SESSION['IS_LOGIN'])){
	header('location:login.php');
	die();
}
echo "Welcome ".$_SESSION['UNAME'];
?>
<br/>
<a href="index.php">index</a> <br>

<a href="userReport.php">User Report</a> <br>
<a href="CropManagement_Report.php">Crop Report</a> <br>

<a href="logout.php">Logout</a>