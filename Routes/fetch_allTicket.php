<?php
include '../configuration/config.php';

$response = [
    'status' => 'error',
    'data' => []
];

$sql = "SELECT * FROM ticket";

$result = mysqli_query($conn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $tickets = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        $response['status'] = 'success';
        $response['data'] = $tickets;
    } else {
        $response['message'] = 'No tickets found.';
    }
} else {
    $response['message'] = 'Failed to retrieve tickets: ' . mysqli_error($conn);
}

mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($response);
?>
