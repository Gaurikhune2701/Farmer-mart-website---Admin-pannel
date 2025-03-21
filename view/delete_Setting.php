<?php
include '../configuration/config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($_GET['id'])) {
    
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $base_url . '/Routes/deleteSetting.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => json_encode(array('id' => $id)),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Cookie: PHPSESSID=q96nf2p41gsmm3kc8ql1orv1l9'
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            echo 'Error:' . curl_error($curl);
        } else {
            $result = json_decode($response, true);

            if (isset($result['status']) && $result['status'] === 'success') {
                $_SESSION['success_status'] = 'Setting has been deleted successfully.';
                echo "<script>
                    window.location.href = '../View/SettingReport.php';
                </script>";
            } else {
                echo "Failed to delete Setting. Reason: " . ($result['message'] ?? 'Unknown error.');
            }
        }

        curl_close($curl);
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'No id provided.'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method.'));
}
