<?php
session_start();
include '../configuration/config.php';
// echo $_GET['email'];
$email = isset($_GET['email']) ? ($_GET['email']) : '';

if ($email > 0) {
    $sql = "SELECT id, mobileNo, password FROM user WHERE email = '$email'";
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
