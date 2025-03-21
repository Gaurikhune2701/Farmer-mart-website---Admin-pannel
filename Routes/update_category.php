<?php
session_start();

include '../configuration/config.php';

$input = file_get_contents('php://input');
$data = json_decode($input, true);
// print_r($data);

if (json_last_error() === JSON_ERROR_NONE && !empty($data)) {
    $sr_no = $data['sr_no'] ?? '';
    $category_name = $data['category_name'] ?? '';
    $status = $data['status'] ?? ''; 
    $image = $data['image'] ?? ''; 
    $description = $data['description'] ?? ''; 

    $sql = "UPDATE crop_category SET category_name = '$category_name', status = '$status', image = '$image', description = '$description' WHERE `sr.no` = '$sr_no'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["status" => "success", "message" => "category updated successfully."]);
        // echo "<script>
        //         alert('Category has been updated successfully.');
        //         window.location.href = '../View/categoryReport.php';
        //     </script>";
    } else {
        echo json_encode(["status" => "error", "message" => "Error updating category: " . mysqli_error($conn)]);
    }

    mysqli_close($conn);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid or missing JSON data."]);
}

?>
