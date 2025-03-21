<?php
session_start();

include '../configuration/config.php';

$input = file_get_contents('php://input');
$data = json_decode($input, true);
// print_r($data);

if (json_last_error() === JSON_ERROR_NONE && !empty($data)) {
    $sr_no = $data['sr_no'] ?? ''; 
    $image = $data['image'] ?? ''; 
    $description = $data['description'] ?? ''; 

    $sql = "UPDATE banner SET `image` = '$image', `description` = '$description' WHERE `sr_no` = '$sr_no'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["status" => "success", "message" => "banner updated successfully."]);
        // echo "<script>
        //         alert('Banner has been updated successfully.');
        //         window.location.href = '../View/bannerReport.php';
        //     </script>";
    } else {
        echo json_encode(["status" => "error", "message" => "Error updating category: " . mysqli_error($conn)]);
    }

    mysqli_close($conn);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid or missing JSON data."]);
}

?>
