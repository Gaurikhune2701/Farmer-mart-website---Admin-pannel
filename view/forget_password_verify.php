<?php
@session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // If you are using Composer, it will autoload the required classes

include '../configuration/config.php';

$msg = "";

if(isset($_POST['submit'])){
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   
   $rand = rand(100000, 999999); // Generate a random 6-digit number

   // Query to check if the email exists in the database
   $query = "SELECT * FROM `user` WHERE `email` = '$email'";
   $result = mysqli_query($conn, $query);

   if(mysqli_num_rows($result) > 0) {
       // Email exists, proceed with sending the OTP
       $mail = new PHPMailer(true);

       try {
           //Server settings
           $mail->isSMTP();                                     
           $mail->Host       = 'smtp.gmail.com';  
           $mail->SMTPAuth   = true;                                  
           $mail->Username   = 'mayuthorat6247@gmail.com';   // Your Gmail address
           $mail->Password   = 'vfymslesjeletzyi';     // Your Gmail App Password
           $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
           $mail->Port       = 587;                                    

           //Recipients
           $mail->setFrom('mayuthorat6247@gmail.com', 'Your Name');  // Sender email and name
           $mail->addAddress($email);  // Recipient email address

           // Content
           $mail->isHTML(true);  // Set email format to HTML
           $mail->Subject = 'Your Verification Code';
           $mail->Body    = "Hi, <br> This is your verification code: $rand";  // HTML email content
           $mail->AltBody = "Hi, This is your verification code: $rand";  // Plain-text email content for non-HTML clients

           $mail->send();
           $_SESSION['otp'] = $rand;  // Store OTP in session for verification
           header('location:otp.php');  // Redirect to OTP verification page
       } catch (Exception $e) {
           echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
       }

   } else {
       // Email does not exist
       $msg = "Email not found in the database.";
   }
}
?>