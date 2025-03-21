<?php 
//  session_start();
include '../configuration/config.php'; // Ensure this file contains your database connection

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['submit'])) {
    // Collect form data
    $crop_name = $_POST['crop_name'];
    $crop_type = $_POST['crop_type'];
    // $crop_description = $_POST['crop_description'];
    $category = $_POST['category'];
    $season = $_POST['season'];
    $category2 = $_POST['category2'];
    $duration = $_POST['duration'];
    $intro = $_POST['intro'];
    $climate = $_POST['climate'];
    $soil = $_POST['soil'];
    $varietiesRecommended = $_POST['varieties_recommended'];
    $land = $_POST['land'];
    $fertilizer = $_POST['fertilizer'];
    $irrigation = $_POST['irrigation'];
    $weedControl = $_POST['weed_control'];
    $harvesting = $_POST['harvesting'];
    $postHarvest = $_POST['post_harvest'];
    // $statuss = $_POST['statuss'];
    $videoLinks = $_POST['videoLinks'];


    // Check if statuss is set; if not, set it to 'active'
    $statuss = isset($_POST['statuss']) ? $_POST['statuss'] : 'active'; 

    // File upload section
$uploaded_image_paths = [];
if (isset($_FILES['photos']) && is_array($_FILES['photos']['tmp_name'])) {
    $total_files = count($_FILES['photos']['name']);
    for ($i = 0; $i < $total_files; $i++) {
        $file_name = $_FILES['photos']['name'][$i];
        $file_tmp = $_FILES['photos']['tmp_name'][$i];
        $file_error = $_FILES['photos']['error'][$i];

        if ($file_error === UPLOAD_ERR_OK) {
            $upload_dir = '../uploads/crops/';
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
    $data = array(
        'crop_name' => $crop_name,
        'crop_type' => $crop_type,
        // 'crop_description' => $crop_description,
        'category' => $category,
        'season' => $season,
        'category2' => $category2,
        'photos' => $image_paths,
        'videoLinks' => $videoLinks,
        'duration' => $duration,
        'intro' => $intro,
        'climate' => $climate,
        'soil' => $soil,
        'varieties_recommended' => $varietiesRecommended,
        'land' => $land,
        'fertilizer' => $fertilizer,
        'irrigation' => $irrigation,
        'weed_control' => $weedControl,
        'harvesting' => $harvesting,
        'post_harvest' => $postHarvest,
        'statuss' => $statuss
    );

    // Encode data to JSON format
  echo  $json_data = json_encode($data);

    // Initialize cURL
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost/CropManageSystem/Routes/addCropManagement.php',
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
        $_SESSION['success_status'] = $json_response['message'] ?? 'Crop Added successfully';
    } else {
        $_SESSION['error_status'] = $json_response['message'] ?? 'Failed to added Crop';
    }

    // Redirect to report page or any other page
    header('Location: ../View/CropManagement_Report.php');
    exit();
}
?>
