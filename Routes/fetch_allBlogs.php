<?php
include '../configuration/config.php';

$sql = "SELECT * FROM blogs";
$result = mysqli_query($conn, $sql);

if ($result) {
    $blogs = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $blogs[] = [
            'id' => $row['id'],
            'title' => $row['title'],
            'image' => $row['image'],
            'description' => $row['description'],
            'publish_date' => $row['publish_date']
        ];
    }

    echo json_encode([
        'status' => 'success',
        'data' => $blogs
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to retrieve blogs: ' . mysqli_error($conn)
    ]);
}

mysqli_close($conn);
?>
