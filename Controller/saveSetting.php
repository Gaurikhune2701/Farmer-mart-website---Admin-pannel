<?php
session_start();
include '../configuration/config.php'; // Ensure this file contains your database connection settings

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['submit'])) {
    // Collect and sanitize form data
    $app_name = $_POST['app_name'];
    //  $app_name = $_POST['photos'];
    $contact_no = $_POST['contact_no'];
    $email_id = $_POST['email_id'];
    $copyrights = $_POST['copyrights'];
    $website = $_POST['website'];
    $facebook_link = $_POST['facebook_link'];
    $whatsapp_link = $_POST['whatsapp_link'];
    $twitter_link = $_POST['twitter_link'];
    $linkedin = $_POST['linkedin'];

// File upload section
$uploaded_image_paths = [];
if (isset($_FILES['photos']) && is_array($_FILES['photos']['tmp_name'])) {
    $total_files = count($_FILES['photos']['name']);
    for ($i = 0; $i < $total_files; $i++) {
        $file_name = $_FILES['photos']['name'][$i];
        $file_tmp = $_FILES['photos']['tmp_name'][$i];
        $file_error = $_FILES['photos']['error'][$i];

        if ($file_error === UPLOAD_ERR_OK) {
            $upload_dir = '../uploads/setting/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $file_path = $upload_dir . basename($file_name);
            if (move_uploaded_file($file_tmp, $file_path)) {
                $uploaded_image_paths[] = $file_path;
            } else {
                error_log('Failed to move uploaded file: ' . $file_name);
                sendJsonResponse(500, 'Failed to upload image');
            }
        } else {
            error_log('Upload error: ' . $file_error);
            sendJsonResponse(500, 'Upload error: ' . $file_error);
        }
    }
}

$image_paths = implode(', ', $uploaded_image_paths);
error_log('Image paths: ' . $image_paths);


    // Prepare data for API
    $data = [
        'photos' => $image_paths,
        'app_name' => $app_name,
        'contact_no' => $contact_no,
        'email_id' => $email_id,
        'copyrights' => $copyrights,
        'website' => $website,
        'facebook_link' => $facebook_link,
        'whatsapp_link' => $whatsapp_link,
        'twitter_link' => $twitter_link,
        'linkedin' => $linkedin,
    ];


    
    // Encode data to JSON format
  echo  $json_data = json_encode($data);
     // Initialize cURL
     $curl = curl_init();

     curl_setopt_array($curl, array(
         CURLOPT_URL => 'localhost/CropManageSystem/Routes/addSetting.php',
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => '',
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 0,
         CURLOPT_FOLLOWLOCATION => true,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => 'POST',
         CURLOPT_POSTFIELDS => $json_data,
         CURLOPT_HTTPHEADER => array(
             'Content-Type: application/json',
             'Cookie: PHPSESSID=gdt3hc3ll8tmam8vrmkt3cdo1v'
         ),
     ));
 
     // Execute the cURL request
   echo  $response = curl_exec($curl);
   curl_close($curl);
 
    // Decode and handle API response
    $json_response = json_decode($response, true);

    if (isset($json_response['success']) && $json_response['success'] === true) {
        $_SESSION['success_status'] = $json_response['message'] ?? 'Data inserted successfully';
    } else {
        $_SESSION['error_status'] = $json_response['message'] ?? 'Failed to insert data';
    }

    // Redirect to report page or any other page
    header('Location: ../View/SettingReport.php');
    exit();
}
?>

