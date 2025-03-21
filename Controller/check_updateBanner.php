<?php
session_start();

include '../configuration/config.php';

if ( $_SERVER['REQUEST_METHOD'] === 'POST') {

    $sr_no = $_POST['sr_no'] ?? '';
    $description = $_POST['description'] ?? '';
    $current_image = $_POST['current_image'];

    if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] == 0) {
        $image_name = $_FILES['new_image']['name'];
        $image_tmp_name = $_FILES['new_image']['tmp_name'];
        $image_folder = '../uploads/banner/' . $image_name;
        
        move_uploaded_file($image_tmp_name, $image_folder);

        $image = $image_folder;
    } else {
        $image = $current_image;
    }

    $data = array(
        'sr_no' => $sr_no,
        'image' => $image,
        'description' => $description
    );
    // print_r($data);

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $base_url . '/Routes/update_banner.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => array(
        'Cookie: PHPSESSID=23qs3lg9d5o1eg88pd95n38gns'
      ),
    ));
    
    echo $response = curl_exec($curl);


    if (curl_errno($curl)) {
        echo 'Error:' . curl_error($curl);
    } else {
        echo $response;
        $_SESSION['success_status'] = 'Banner has been updated successfully.';
        echo "<script>
                window.location.href = '../View/bannerReport.php';
            </script>";
    }

    curl_close($curl);
} else {
    echo 'Invalid request method. Please submit the form properly.';
}
?>
