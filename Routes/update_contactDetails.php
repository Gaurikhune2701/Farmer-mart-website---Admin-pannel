<?php
session_start();

include '../configuration/config.php';

$input = file_get_contents('php://input');
$data = json_decode($input, true);
// print_r($data);

if (json_last_error() === JSON_ERROR_NONE && !empty($data)) {
    $id = $data['id'] ?? '';
    $phone = $data['phone'] ?? '';
    $email = $data['email_id'] ?? ''; 
    $address = $data['address'] ?? ''; 
    $copyrights = $data['copyrights'] ?? ''; 
    $contents = $data['contents'] ?? ''; 

    if (!empty($id) && !empty($phone) && !empty($email) && !empty($address) && !empty($copyrights) && !empty($contents)) {
        $sql = "UPDATE company_contact_details 
                SET phone = '$phone', email_id = '$email', address = '$address', copyrights = '$copyrights', contents = '$contents' 
                WHERE id = '$id'";

        if (mysqli_query($conn, $sql)) {
            echo json_encode(["status" => "success", "message" => "Contact details updated successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error updating contact details: " . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Missing required fields."]);
    }

    mysqli_close($conn);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid or missing JSON data."]);
}

?>
