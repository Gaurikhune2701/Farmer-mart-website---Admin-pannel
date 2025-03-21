<?php
include '../configuration/config.php';

$sql = "SELECT COUNT(*) AS community_count FROM community";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $count = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($count);
} else {
    echo json_encode([]);
}

mysqli_close($conn);
?>

