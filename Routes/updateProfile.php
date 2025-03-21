<?php
header('Content-Type: application/json');
session_start();
include '../configuration/config.php'; // Database connection

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve the input JSON data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Validate required fields
    // if (!isset($data['email'], $data['full_name'], $data['designation'], $data['mobileNo'])) {
    //     echo json_encode(array(
    //         'success' => false,
    //         'message' => 'Required fields are missing.'
    //     ));
    //     exit();
    // }

    // Assign variables from input
    $email = mysqli_real_escape_string($conn, trim($data['email']));
    $full_name = mysqli_real_escape_string($conn, trim($data['full_name']));
    $designation = mysqli_real_escape_string($conn, trim($data['designation']));
    $mobileNo = mysqli_real_escape_string($conn, trim($data['mobileNo']));
    $id = isset($data['id']) ? intval($data['id']) : 0;

    // Check if the profile exists using the email or ID
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Update the profile details
        $sql_update = "UPDATE user SET full_name = '$full_name', designation = '$designation', mobileNo = '$mobileNo' WHERE email = '$email'";

        if (mysqli_query($conn, $sql_update)) {
            // Success response
            echo json_encode(array(
                'success' => true,
                'message' => 'Profile updated successfully.'
            ));
        } else {
            // Error updating the profile
            echo json_encode(array(
                'success' => false,
                'message' => 'Failed to update the profile. Please try again later.'
            ));
        }
    } else {
        // Profile not found
        echo json_encode(array(
            'success' => false,
            'message' => 'Profile not found.'
        ));
    }

} else {
    // Invalid request method
    echo json_encode(array(
        'success' => false,
        'message' => 'Invalid request method. Please use POST.'
    ));
}

mysqli_close($conn);
?>
