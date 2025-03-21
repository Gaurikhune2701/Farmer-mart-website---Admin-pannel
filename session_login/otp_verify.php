<?php
@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$msg = "";
$otp = strval($_SESSION['otp']); // Convert session OTP to string

if (isset($_POST['otp_forget'])) {
    // Concatenate the six digits to form the full OTP
    $submit_otp = $_POST['digit_1'] . $_POST['digit_2'] . $_POST['digit_3'] . 
                  $_POST['digit_4'] . $_POST['digit_5'] . $_POST['digit_6'];

    // Check if the concatenated OTP matches the session OTP
    if ($submit_otp == $otp) {
        // OTP is correct, redirect to the new password page
        header("location:new_password.php");
        exit;
    } else {
        // OTP is incorrect, show error message
        $_SESSION['otp_error'] = "Please Enter valid OTP";
        header("location:otp.php");
        exit;
    }
}
?>
