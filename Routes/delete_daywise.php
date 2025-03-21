<?php
session_start();
include "../configuration/config.php";

// Get ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Validate ID
if ($id <= 0) {
    die("Invalid ID");
}

// Initialize cURL for deletion
$curl = curl_init();

// Set cURL options for deletion
curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost/CropManageSystem/Routes/delete_crop.php?id=' . $id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 60, // Increased timeout
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

// Execute cURL request and get the response
$response = curl_exec($curl);

// Check for cURL errors
if (curl_errno($curl)) {
    echo 'cURL Error: ' . curl_error($curl);
    curl_close($curl);
    exit;
}

// Close cURL session
curl_close($curl);

// Decode JSON response
$data = json_decode($response, true);

// Check if the deletion was successful
if (isset($data['status']) && $data['status']) {
    $_SESSION['success_status'] = 'Crop Daywise data has been deleted successfully!';
    header('Location: ../view/CropDaywise_report.php');
    exit;
} else {
    echo 'Error deleting record: ' . htmlspecialchars($data['msg']);
}
?>
