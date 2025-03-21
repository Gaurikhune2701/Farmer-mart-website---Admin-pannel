<?php
include '../configuration/config.php';

$sql = "SELECT * FROM crop_category";
$result = mysqli_query($conn, $sql);

if ($result) {
    $categories = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = [
            'sr.no' => $row['sr.no'],
            'category_name' => $row['category_name'],
            'status' => $row['status'],
            'description' => $row['description'],
            'image' => $row['image'],
        ];
    }

    echo json_encode([
        'status' => 'success',
        'data' => $categories
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to retrieve categories: ' . mysqli_error($conn)
    ]);
}

mysqli_close($conn);
?>
