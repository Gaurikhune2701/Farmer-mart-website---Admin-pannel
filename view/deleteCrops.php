<?php
// Include database connection
include '../configuration/config.php';

// Check if the request is DELETE
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Perform the cURL request to delete the crop
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://localhost/CropManageSystem/Routes/deleteCrop.php?id={$id}",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE', // Use DELETE request
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: PHPSESSID=189gp2huadkvh5qcqt8v1srnum'
          ),
        ));

    $response = curl_exec($curl);

    // Check for cURL errors
    if (curl_errno($curl)) {
        echo 'Error: ' . curl_error($curl);
    } else {
        // Decode the response
        $result = json_decode($response, true);

        // Display the response message
        if (isset($result['status']) && $result['status'] === 'success') {
            echo "<script>
                alert('Crop with ID {$id} deleted successfully.');
                window.location.href = 'userReport.php';
            </script>";
        } else {
            echo "Failed to delete crop. Reason: " . ($result['message'] ?? 'Unknown error.');
        }
    }

    // Close the cURL session
    curl_close($curl);
} else {
    echo json_encode(array('status' => 'error', 'message' => 'No ID provided or ID is empty.'));
}
