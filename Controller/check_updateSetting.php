<?php
// session_start();

include '../configuration/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Define the setting fields
    $id = $_POST['id'] ?? '';
    $app_name = $_POST['app_name'] ?? '';
    $contact_no = $_POST['contact_no'] ?? '';
    $email_id = $_POST['email_id'] ?? '';
    $website = $_POST['website'] ?? '';
    $copyrights = $_POST['copyrights'] ?? '';
    $facebook_link = $_POST['facebook_link'] ?? '';
    $whatsapp_link = $_POST['whatsapp_link'] ?? '';
    $twitter_link = $_POST['twitter_link'] ?? '';
    $linkedin = $_POST['linkedin'] ?? '';
    $current_image = $_POST['current_image'] ?? '';

    // Check if a new image is being uploaded
    if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] == 0) {
        $new_image_name = $_FILES['new_image']['name'];
        $new_image_tmp_name = $_FILES['new_image']['tmp_name'];
        $new_image_folder = '../uploads/setting/' . $new_image_name;
        
        // Move the uploaded file to the desired directory
        move_uploaded_file($new_image_tmp_name, $new_image_folder);

        $image = $new_image_folder;
    } else {
        $image = $current_image;
    }

    // Prepare data array
    $data = array(
        'id' => $id,
        'app_name' => $app_name,
        'contact_no' => $contact_no,
        'email_id' => $email_id,
        'website' => $website,
        'copyrights' => $copyrights,
        'facebook_link' => $facebook_link,
        'whatsapp_link' => $whatsapp_link,
        'twitter_link' => $twitter_link,
        'linkedin' => $linkedin,
        'photos' => $image
    );

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'localhost/CropManageSystem/Routes/update_setting.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode($data),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Cookie: PHPSESSID=3m2i3mcbj094iiqgaohi39opep'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;


    // Handle cURL errors or successful execution
    if (curl_errno($curl)) {
        echo 'Error:' . curl_error($curl);
    } else {
        echo $response;
        $_SESSION['success_status'] = 'Settings have been updated successfully.';
        echo "<script>
                window.location.href = '../view/SettingReport.php';
            </script>";
    }

    // Close cURL request
    curl_close($curl);
} else {
    echo 'Invalid request method. Please submit the form properly.';
}
?>
