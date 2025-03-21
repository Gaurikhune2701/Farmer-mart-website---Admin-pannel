<?php
include '../configuration/config.php';
unset($_SESSION['IS_LOGIN']);
header('location:dashboard.php');
die();
?>