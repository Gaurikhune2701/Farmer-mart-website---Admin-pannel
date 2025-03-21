<?php
include '../configuration/config.php';

$sql = "SELECT category_name FROM crop_category"; // Adjusted query to select only category_name
$result = mysqli_query($conn, $sql);

if ($result) {
    $categories = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        // Only add category_name to the array
        $categories[] = $row['category_name'];
    }

    echo json_encode([
        'status' => 'success',
        'data' => $categories // Return only category names
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to retrieve categories: ' . mysqli_error($conn)
    ]);
}

mysqli_close($conn);
?>
