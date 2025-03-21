<?php
// Include database configuration
include '../configuration/config.php'; // Ensure this file contains your database connection settings

// Retrieve POST data
$data = json_decode(file_get_contents('php://input'), true);

// Sanitize and validate input data
$app_name = mysqli_real_escape_string($conn, $data['app_name']);
$contact_no = mysqli_real_escape_string($conn, $data['contact_no']);
$email_id = mysqli_real_escape_string($conn, $data['email_id']);
$website = mysqli_real_escape_string($conn, $data['website']);
$copyrights = mysqli_real_escape_string($conn, $data['copyrights']);
$facebook_link = mysqli_real_escape_string($conn, $data['facebook_link']);
$whatsapp_link = mysqli_real_escape_string($conn, $data['whatsapp_link']);
$twitter_link = mysqli_real_escape_string($conn, $data['twitter_link']);
$linkedin = mysqli_real_escape_string($conn, $data['linkedin']);
$image_paths = $data['photos'];


// Construct the SQL query
$sql = "INSERT INTO `setting` (`photos`, `app_name`, `contact_no`, `email_id`, `website`, `copyrights`, `facebook_link`, `whatsapp_link`, `twitter_link`, `linkedin`)
        VALUES ('$image_paths', '$app_name', '$contact_no', '$email_id', '$website', '$copyrights', '$facebook_link', '$whatsapp_link', '$twitter_link', '$linkedin')";

// Check if the connection is still open
if ($conn) {
    // Execute the query
    if (mysqli_query($conn, $sql)) {
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Data created successfully']);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Data failed to be inserted', 'error' => mysqli_error($conn)]);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Database connection lost']);
}

// Close the database connection
mysqli_close($conn);
?>
