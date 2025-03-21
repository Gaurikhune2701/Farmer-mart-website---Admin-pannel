<?php
include '../configuration/config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($_GET['sr_no'])) {

    if (isset($_GET['sr_no']) && !empty($_GET['sr_no'])) {
        $sr_no = $_GET['sr_no'];

        $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $base_url . '/Routes/delete_category.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_POSTFIELDS =>json_encode(array('sr.no' => $sr_no)),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Cookie: PHPSESSID=23qs3lg9d5o1eg88pd95n38gns'
  ),
));

    $response = curl_exec($curl);

        if (curl_errno($curl)) {
            echo 'Error:' . curl_error($curl);
        } else {
            $result = json_decode($response, true);

            if (isset($result['status']) && $result['status'] === 'success') {
                $_SESSION['success_status'] = 'Category has been deleted successfully.';
                echo "<script>
                    window.location.href = '../View/categoryReport.php';
                </script>";            
            } else {
                echo "Failed to delete category. Reason: " . ($result['message'] ?? 'Unknown error.');
            }
        }

        curl_close($curl);
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'No sr.no provided.'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method.'));
}
