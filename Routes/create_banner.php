<?php
include '../configuration/config.php';

$data = json_decode(file_get_contents('php://input'), true);
// print_r($data);
if (json_last_error() === JSON_ERROR_NONE) {
    $image_paths = $data['image'] ?? '';
    $category_description = $data['description'] ?? '';

    $sql = "INSERT INTO banner (image, description) VALUES ('$image_paths', '$category_description')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode([
            'status' => 'success',
            'message' => 'banner added successfully.',
        ]);
        // header('Location: ../View/bannerReport.php');
        // exit();
    } else {
        echo json_encode(['error' => true, 'message' => 'Failed to create banner: ' . mysqli_error($conn)]);
    }
} else {
    echo json_encode(['error' => true, 'message' => 'Invalid JSON data']);
}

mysqli_close($conn);
?>
