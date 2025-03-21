<?php
session_start();
include '../configuration/config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "SELECT * FROM user WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        header('Content-Type: application/json');
        echo json_encode($user);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}

mysqli_close($conn);
?>
