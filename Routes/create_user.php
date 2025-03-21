<?php
include '../configuration/config.php';

$data = json_decode(file_get_contents('php://input'), true);

$full_name = $data['full_name'];
$designation = $data['designation'];
$mobileNo = $data['mobileNo'];
$email = $data['email'];
$password = $data['password'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO user (full_name, designation, mobileNo, email, password) VALUES ('$full_name', '$designation', '$mobileNo', '$email', '$hashed_password')";

if (mysqli_query($conn, $sql)) {
    echo json_encode([
        'status' => 'success',
        'message' => 'user added successfully.',
    ]);
    // header('Location: ../View/userReport.php');
    // exit();
} else {
    echo json_encode(['error' => true, 'message' => 'Failed to create user']);
}

mysqli_close($conn);
?>
