<?php
include '../configuration/config.php';
@session_start(); // Start the session
$msg = "";

// Check if the form is submitted
if (isset($_POST['reset_submit'])) {
    $new_password = $_POST['new_password'];
    $con_password = $_POST['confirm_password'];

    // Check if the new password and confirm password match
    if ($new_password == $con_password) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Get the user's email from the session
        if (isset($_SESSION['UNAME'])) {
            $email = $_SESSION['UNAME']; // Retrieve the email from the session

            // Prepare the SQL query to update the password
            $updt_query = "UPDATE `user` SET `password` = ? WHERE `email` = ?";
            
            // Use prepared statements to prevent SQL injection
            if ($stmt = mysqli_prepare($conn, $updt_query)) {
                mysqli_stmt_bind_param($stmt, 'ss', $hashed_password, $email);
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    $msg = "Password updated successfully.";
                    // Redirect to login page with a success message
                    header('Location:login.php?msg=' . urlencode($msg));
                    exit();
                } else {
                    $msg = "Error updating password. Please try again.";
                }
                mysqli_stmt_close($stmt);
            } else {
                $msg = "Failed to prepare SQL query.";
            }
        } else {
            $msg = "No user email found in session.";
        }
    } else {
        $msg = "New password does not match with confirm password!";
    }
}
?>
