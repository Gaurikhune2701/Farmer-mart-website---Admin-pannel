<?php
include '../configuration/config.php';

$data = json_decode(file_get_contents('php://input'), true);
// print_r($data);
if (json_last_error() === JSON_ERROR_NONE) {
    $title = $data['title'] ?? '';
    $image_path = $data['image'] ?? '';
    $description = $data['description'] ?? '';

    $sql = "INSERT INTO blogs (title, image, description, publish_date) VALUES ('$title', '$image_path', '$description', now())";

    if (mysqli_query($conn, $sql)) {
        echo json_encode([
            'status' => 'success',
            'message' => 'blog added successfully.',
        ]);
        // header('Location: ../View/blogsReport.php');
        // exit();
    } else {
        echo json_encode(['error' => true, 'message' => 'Failed to create blog: ' . mysqli_error($conn)]);
    }
} else {
    echo json_encode(['error' => true, 'message' => 'Invalid JSON data']);
}

mysqli_close($conn);
?>
