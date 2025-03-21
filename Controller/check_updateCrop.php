<?php
// session_start();

include '../configuration/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Define crop-related fields
    $id = $_POST['id'] ?? '';
    $crop_name = $_POST['crop_name'] ?? '';
    $crop_type = $_POST['crop_type'] ?? '';
    $category = $_POST['category'] ?? '';
    $season = $_POST['season'] ?? '';
    $climate = $_POST['climate'] ?? '';
    $soil = $_POST['soil'] ?? '';
    $varieties_recommended = $_POST['varieties_recommended'] ?? '';
    $land = $_POST['land'] ?? '';
    $fertilizer = $_POST['fertilizer'] ?? '';
    $irrigation = $_POST['irrigation'] ?? '';
    $weed_control = $_POST['weed_control'] ?? '';
    $harvesting = $_POST['harvesting'] ?? '';
    $post_harvest = $_POST['post_harvest'] ?? '';
    $category2 = $_POST['category2'] ?? '';
    $duration = $_POST['duration'] ?? '';
    $intro = $_POST['intro'] ?? '';
    $videolinks = $_POST['videolinks'] ?? '';
    // $crop_description = $_POST['crop_description'] ?? '';
    $statuss = $_POST['statuss'] ?? '';
    $current_image = $_POST['current_image'] ?? '';

    // Check if a new image is being uploaded
    if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] == 0) {
        $image_name = $_FILES['new_image']['name'];
        $image_tmp_name = $_FILES['new_image']['tmp_name'];
        $image_folder = '../uploads/crops/' . $image_name;

        // Move the uploaded file to the desired directory
        move_uploaded_file($image_tmp_name, $image_folder);

        $image = $image_folder;
    } else {
        $image = $current_image;
    }

    // Prepare data array
    $data = array(
        'id' => $id,
        'crop_name' => $crop_name,
        'crop_type' => $crop_type,
        'category' => $category,
        'season' => $season,
        'climate' => $climate,
        'soil' => $soil,
        'varieties_recommended' => $varieties_recommended,
        'land' => $land,
        'fertilizer' => $fertilizer,
        'irrigation' => $irrigation,
        'weed_control' => $weed_control,
        'harvesting' => $harvesting,
        'post_harvest' => $post_harvest,
        'category2' => $category2,
        'duration' => $duration,
        'intro' => $intro,
        'videolinks' => $videolinks,
        'photos' => $image,
        'statuss' => $statuss,
        // 'crop_description' => $crop_description
    );

    // Initialize cURL request
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost/CropManageSystem/Routes/update_crop.php',
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
            'Cookie: PHPSESSID=3m2i3mcbj094iiqgaohi39opep'
        ),
    ));

    $response = curl_exec($curl);

    // Handle cURL errors or successful execution
    if (curl_errno($curl)) {
        echo 'Error: ' . curl_error($curl);
    } else {
        $decoded_response = json_decode($response, true);

        if ($decoded_response && $decoded_response['status'] == 'success') {
            $_SESSION['success_status'] = 'Crop has been updated successfully.';
            echo "<script>
                    window.location.href = '../view/CropManagement_Report.php';
                </script>";
        } else {
            echo 'Error in updating crop: ' . $response;
        }
    }

    // Close cURL request
    curl_close($curl);
} else {
    echo 'Invalid request method. Please submit the form properly.';
}
?>
