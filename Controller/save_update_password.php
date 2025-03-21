<?php
// @session_start();

include '../Configuration/config.php';

// Check if the form has been submitted
if (isset($_POST['update_password'])) {
    // Retrieve and sanitize the phone number and new password
    $email = trim($_POST['email']);
    $phone = isset($_POST['phone']) ? mysqli_real_escape_string($conn, $_POST['phone']) : null;
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validate input
    if (empty($phone) || empty($password)) {
        $_SESSION['error_status'] = 'Phone number or password cannot be empty.';
        header("Location: ../View/update_password.php?phone=" . urlencode($phone));
        exit();
    }

    // Hash the new password (important for security)
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare the SQL update query
    $sql = "UPDATE `user` SET `password` = '$hashedPassword' WHERE `email` = '$email'";

    // Execute the query and check if it was successful
    if (mysqli_query($conn, $sql)) {
        $_SESSION['success_status'] = 'Password updated successfully!';
    } else {
        $_SESSION['error_status'] = 'Failed to update password: ' . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);

    // Redirect to the user report page or back to the form with a status message
    header("Location: ../View/user_report.php");
    exit();
} else {
    // If the form hasn't been submitted, redirect to the form page
    header("Location: ../View/update_password_form.php");
    exit();
}
?>
