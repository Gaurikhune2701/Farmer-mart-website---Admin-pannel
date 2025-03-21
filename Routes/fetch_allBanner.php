<?php
include '../configuration/config.php';

$sql = "SELECT * FROM banner";
$result = mysqli_query($conn, $sql);

if ($result) {
    $banners = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $banners[] = [
            'sr_no' => $row['sr_no'],
            'image' => $row['image'],
            'description' => $row['description'],
        ];
    }

    echo json_encode([
        'status' => 'success',
        'data' => $banners
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to retrieve categories: ' . mysqli_error($conn)
    ]);
}

mysqli_close($conn);
?>
