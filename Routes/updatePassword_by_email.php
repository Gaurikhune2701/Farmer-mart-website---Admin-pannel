<?php
session_start();

include '../configuration/config.php';

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (json_last_error() === JSON_ERROR_NONE && !empty($data)) {
    $id = $data['id'] ?? '';
    // $full_name = $data['full_name'] ?? '';
    // $designation = $data['designation'] ?? '';
    // $mobileNo = $data['mobileNo'] ?? '';
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE user SET password = '$hashed_password' WHERE email = '$email'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["status" => "success", "message" => "User password updated successfully."]);
        // echo "<script>
        //         alert('Password has been updated successfully.');
        //         window.location.href = '../view/index.php';
        //     </script>";
    } else {
        echo json_encode(["status" => "error", "message" => "Error updating user: " . mysqli_error($conn)]);
    }

    mysqli_close($conn);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid or missing JSON data."]);
}
?>
