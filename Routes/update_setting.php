<?php
// session_start();
include '../configuration/config.php';

// Get the JSON input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Check for valid JSON input
if (json_last_error() === JSON_ERROR_NONE && !empty($data)) {
    // Assign data to variables
    $id = $data['id'] ?? '';
    $app_name = $data['app_name'] ?? '';
    $contact_no = $data['contact_no'] ?? '';
    $email_id = $data['email_id'] ?? '';
    $website = $data['website'] ?? '';
    $copyrights = $data['copyrights'] ?? '';
    $facebook_link = $data['facebook_link'] ?? '';
    $whatsapp_link = $data['whatsapp_link'] ?? '';
    $twitter_link = $data['twitter_link'] ?? '';
    $linkedin = $data['linkedin'] ?? '';
    $image = $data['photos'] ?? '';
    // $current_image = $data['current_image'] ?? '';

    // SQL query to update settings
    $sql = "UPDATE setting SET 
            app_name = '$app_name', 
            contact_no = '$contact_no', 
            email_id = '$email_id', 
            website = '$website', 
            copyrights = '$copyrights', 
            facebook_link = '$facebook_link', 
            whatsapp_link = '$whatsapp_link', 
            twitter_link = '$twitter_link', 
            linkedin = '$linkedin', 
            photos = '$image' 
            WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["status" => "success", "message" => "Settings updated successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error updating settings: " . mysqli_error($conn)]);
    }

    mysqli_close($conn);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid or missing JSON data."]);
}
?>
