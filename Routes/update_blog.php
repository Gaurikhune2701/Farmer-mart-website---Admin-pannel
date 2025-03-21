<?php
session_start();
include '../configuration/config.php';

$data = json_decode(file_get_contents('php://input'), true);
// print_r($data);

if (json_last_error() === JSON_ERROR_NONE && !empty($data)) {

    $id = $data['id'] ?? ''; 
    $title = $data['title'] ?? ''; 
    $image = $data['image'] ?? ''; 
    $description = $data['description'] ?? ''; 

    $sql = "UPDATE blogs SET `title` = '$title', `image` = '$image', `description` = '$description', `publish_date` = NOW() WHERE `id` = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["status" => "success", "message" => "blog updated successfully."]);
        // echo "<script>
        //         alert('Blog has been updated successfully.');
        //         window.location.href = '../View/blogsReport.php';
        //     </script>";
    } else {
        echo json_encode(["status" => "error", "message" => "Error updating blog: " . mysqli_error($conn)]);
    }

    mysqli_close($conn);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid or missing JSON data."]);
}

?>
