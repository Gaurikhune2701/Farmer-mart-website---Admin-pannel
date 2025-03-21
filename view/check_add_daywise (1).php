<?php
// session_start(); // Start session if needed
include '../configuration/config.php'; // Include any required configurations (optional if not using DB)

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Debugging: Log the entire POST data for review
    error_log(print_r($_POST, true)); // Log POST data for debugging

    // Collect form data safely
   echo  $crop_id = $_POST['crop_id'] ?? ''; // Add crop_id here
    $crop_name = $_POST['crop_name'] ?? '';
    $duration = $_POST['duration'] ?? '';
    $day_no = $_POST['day_no'] ?? '';
    $day_description = $_POST['day_description'] ?? '';
    $notes = $_POST['notes'] ?? '';
    $vanaspati_stage = $_POST['vanaspati_stage'] ?? '';
    $work = $_POST['work'] ?? '';
    $spray_drenching = $_POST['spray_drenching'] ?? '';
    $worker_count = $_POST['worker_count'] ?? 0;
    $video_urls = $_POST['video_urls'] ?? [];

    // Debugging: Log the collected data
    error_log("Collected Data: " . print_r([
        "crop_id" => $crop_id,
        "crop_name" => $crop_name,
        "duration" => $duration,
        "day_no" => $day_no,
        "day_description" => $day_description,
        "notes" => $notes,
        "vanaspati_stage" => $vanaspati_stage,
        "work" => $work,
        "spray_drenching" => $spray_drenching,
        "worker_count" => $worker_count,
        "video_urls" => $video_urls
    ], true));

    // Handle file uploads
    $uploaded_image_paths = [];
    if (isset($_FILES['photos'])) {
        $total_files = count($_FILES['photos']['name']);
        for ($i = 0; $i < $total_files; $i++) {
            $file_name = $_FILES['photos']['name'][$i];
            $file_tmp = $_FILES['photos']['tmp_name'][$i];
            $file_error = $_FILES['photos']['error'][$i];

            if ($file_error === UPLOAD_ERR_OK) {
                $upload_dir = '../uploads/daywise/'; // Define the directory where the images will be uploaded
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true); // Create directory if it doesn't exist
                }
                $file_path = $upload_dir . basename($file_name);
                if (move_uploaded_file($file_tmp, $file_path)) {
                    $uploaded_image_paths[] = '../uploads/daywise/' . basename($file_name); // Collect paths of uploaded images
                } else {
                    $_SESSION['error'] = 'Failed to upload image';
                    exit();
                }
            }
        }
    }

    // Prepare the data for the cURL POST request, including the crop_id
    $postData = [
        "crop_id" => (int)$crop_id, // Ensure crop_id is included here
        "crop_name" => $crop_name,
        "duration" => $duration,
        "day_no" => (int)$day_no,
        "day_description" => $day_description,
        "notes" => $notes,
        "vanaspati_stage" => $vanaspati_stage,
        "work" => $work,
        "spray_drenching" => $spray_drenching,
        "worker_count" => (int)$worker_count,
        "photos" => $uploaded_image_paths,
        "video_urls" => $video_urls
    ];
print_r( $postData);
    // Debugging: Log the post data being sent
    error_log("Post Data for cURL: " . json_encode($postData));

    // Initialize cURL session
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => 'http://localhost/CropManageSystem/Routes/dewise.php', // Replace with your actual API URL
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($postData), // Send JSON data
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json', // Set JSON content type
            'Cookie: PHPSESSID=' . session_id() // Pass session ID if needed
        ],
    ]);

    // Execute cURL and get the response
    $response = curl_exec($curl);

    // Check for any errors in the cURL execution
    if (curl_errno($curl)) {
        $error_message = curl_error($curl);
        $_SESSION['error'] = "cURL Error: $error_message";
        exit();
    }

    // Close cURL session
    curl_close($curl);

    // Process the API response
    $responseData = json_decode($response, true); // Assuming the response is in JSON format
    error_log("Response from API: " . print_r($responseData, true)); // Log the response for debugging

    // Handle success or failure based on the API response
    if (isset($responseData['success']) && $responseData['success'] === true) {
        $_SESSION['message'] = $responseData['message'] ?? 'Daywise description added successfully!';
        exit();
    } else {
        $_SESSION['error'] = $responseData['message'] ?? 'Failed to add daywise description. Please try again.';
        exit();
    }
}
?>
