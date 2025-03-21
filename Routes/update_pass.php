<?php

// include '../Configuration/config.php';

// $data = json_encode(['phone' => $phone]);
// // Get POST data
//  $phone = isset($_POST['phone']) ? mysqli_real_escape_string($conn, $_POST['phone']) : '';
// $newPassword = isset($_POST['newPassword']) ? mysqli_real_escape_string($conn, $_POST['newPassword']) : '';

// // Hash the new password (important for security)
// $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

// // Prepare the SQL update query
//   echo $sql = "UPDATE `warehouse_user` SET `password` = '$hashedPassword' WHERE `phone` = '$phone'";

// // Execute the query and check if it was successful
// if (mysqli_query($conn, $sql)) {
//     echo json_encode(['msg' => 'Password updated successfully!', 'status' => true]);
// } else {
//     echo json_encode(['msg' => 'Failed to update password: ' . mysqli_error($conn), 'status' => false]);
// }

// // Close the connection
// mysqli_close($conn);

// @session_start();

include '../Configuration/config.php';

// Check if the form has been submitted
if (isset($_POST['update_password'])) {
    // Retrieve and sanitize the phone number and password
    $phone = isset($_POST['phone']) ? mysqli_real_escape_string($conn, $_POST['phone']) : null;
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($phone) || empty($password)) {
        die('Invalid input.');
    }

    // Hash the new password (important for security)
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare the SQL update query
    $sql = "UPDATE `warehouse_user` SET `password` = '$hashedPassword' WHERE `phone` = '$phone'";

    // Execute the query and check if it was successful
    if (mysqli_query($conn, $sql)) {
        $_SESSION['success_status'] = 'Password updated successfully!';
    } else {
        $_SESSION['error_status'] = 'Failed to update password: ' . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);

    // Redirect to the user report page
    header("Location: ../View/user_report.php");
    exit();
}
?>


?>