<?php
include '../configuration/config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (json_last_error() === JSON_ERROR_NONE) {
    $category_name = $data['category_name'] ?? '';
    $category_status = $data['status'] ?? '';
    $category_description = $data['description'] ?? '';
    $image_paths = $data['image'] ?? '';

    $sql = "INSERT INTO crop_category (category_name, status, description, image) 
            VALUES ('$category_name', '$category_status', '$category_description', '$image_paths')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode([
            'status' => 'success',
            'message' => 'category added successfully.',
        ]);
        // header('Location: ../View/categoryReport.php');
        // exit();
    } else {
        echo json_encode(['error' => true, 'message' => 'Failed to create category: ' . mysqli_error($conn)]);
    }
} else {
    echo json_encode(['error' => true, 'message' => 'Invalid JSON data']);
}

mysqli_close($conn);
?>
