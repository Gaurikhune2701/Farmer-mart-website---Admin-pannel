<?php
include '../configuration/config.php';

$sql = "SELECT * FROM community";
$result = mysqli_query($conn, $sql);

if ($result) {
    $communities = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $communities[] = [
            'sr_no' => $row['sr_no'],
            'customer_name' => $row['customer_name'],
            'title' => $row['title'],
            'description' => $row['description'],
            'image' => $row['image'],
            'video' => $row['video'],
            'status' => $row['status'],

        ];
    }

    echo json_encode([
        'status' => 'success',
        'data' => $communities
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to retrieve communities: ' . mysqli_error($conn)
    ]);
}

mysqli_close($conn);
?>
