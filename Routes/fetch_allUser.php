<?php
include '../configuration/config.php';

$sql = "SELECT * FROM user";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($users);
} else {
    echo json_encode([]);
}

mysqli_close($conn);
?>

