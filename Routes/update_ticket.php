<?php
session_start();

include '../configuration/config.php';

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (json_last_error() === JSON_ERROR_NONE && !empty($data)) {
    $id = $data['ticket_id'] ?? '';
    $title = $data['title'] ?? ''; 
    $customer_name = $data['customer_name'] ?? '';
    $description = $data['description'] ?? '';  
    $assigned_to = $data['assign_to'] ?? ''; 
    $created_at = $data['created_at'] ?? ''; 
    $due_date = $data['due_date'] ?? ''; 
    $status = $data['status'] ?? '';
    $priority = $data['priority'] ?? '';

    $sql = "UPDATE ticket SET assign_to = '$assigned_to', due_date = '$due_date', status = '$status', priority = '$priority' WHERE ticket_id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["status" => "success", "message" => "Ticket updated successfully."]);
        // echo "<script>
        //         alert('Ticket has been updated successfully.');
        //         window.location.href = '../View/ticketReport.php';
        //     </script>";
    } else {
        echo json_encode(["status" => "error", "message" => "Error updating ticket: " . mysqli_error($conn)]);
    }

    mysqli_close($conn);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid or missing JSON data."]);
}
?>
