<?php
session_start();

include '../configuration/config.php';

if ( $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email_id = $_POST['email_id'] ?? '';
    $copyrights = $_POST['copyrights'] ?? '';
    $address = $_POST['address'] ?? '';
    $contents = $_POST['contents'] ?? ''; 

    $data = array(
        'id' => $id,
        'phone' => $phone,
        'email_id' => $email_id,
        'copyrights' => $copyrights,
        'address' => $address,
        'contents' => $contents
    );

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $base_url . '/Routes/update_contactDetails.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Cookie: PHPSESSID=23qs3lg9d5o1eg88pd95n38gns'
      ),
    ));
    
    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        echo 'Error:' . curl_error($curl);
    } else {
        // echo $response;
        $_SESSION['success_status'] = 'Contact Details has been updated successfully.';
        echo "<script>
                window.location.href = '../View/contactDetailsReport.php';
            </script>";
    }

    curl_close($curl);
} else {
    echo 'Invalid request method. Please submit the form properly.';
}
?>
