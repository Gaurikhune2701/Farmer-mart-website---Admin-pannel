<?php
session_start();
include '../configuration/config.php';

$sr_no = isset($_GET['sr_no']) ? intval($_GET['sr_no']) : 0;
$data = json_decode(file_get_contents('php://input'), true);

if ($sr_no > 0) {
     $sql = "SELECT * FROM crop_category WHERE `sr.no` = $sr_no";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $category = mysqli_fetch_assoc($result);

        header('Content-Type: application/json');
        // echo json_encode($category);
       echo json_encode([
            'status' => 'success',
            'data' => $category
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
