<?php
session_start();
include '../configuration/config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$data = json_decode(file_get_contents('php://input'), true);

if ($id > 0) {
     $sql = "SELECT * FROM blogs WHERE `id` = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $blog = mysqli_fetch_assoc($result);

        header('Content-Type: application/json');
        // echo json_encode($blog);
       echo json_encode([
            'status' => 'success',
            'data' => $blog
        ]);
    } else {
        header('Content-Type: application/json');
        echo json_encode([]);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode([]);
}

mysqli_close($conn);
?>
