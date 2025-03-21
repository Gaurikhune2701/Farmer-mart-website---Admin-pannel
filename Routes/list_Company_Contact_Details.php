<?php
header('Content-Type: application/json');
include '../configuration/config.php';

$response = array();

// Fetch all contact details
$sql = "SELECT * FROM `company_contact_details`";
$result = $conn->query($sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $contacts = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $response['status'] = 'success';
        $response['data'] = $contacts;
    } else {
        $response['status'] = 'error';
        $response['message'] = 'No contact details found!';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Database query failed: ' . $conn->error;
}

// Close the connection
$conn->close();

// Return the response as JSON
echo json_encode($response);
?>
