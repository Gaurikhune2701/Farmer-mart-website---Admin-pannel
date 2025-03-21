<?php
include '../configuration/config.php'; // Ensure this file contains your database connection settings

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $crop_id = $_POST['crop_id'];
    $crop_name = $_POST['crop_name'];
    $duration = $_POST['duration'];
    $day_no = $_POST['day_no'];
    $day_description = $_POST['day_description'];
    $notes = $_POST['notes'];
    $vanaspati_stage = $_POST['vanaspati_stage'];
    $work = $_POST['work'];
    $spray_drenching = $_POST['spray_drenching'];
    $worker_count = $_POST['worker_count'];
    $video_urls = isset($_POST['video_urls']) ? $_POST['video_urls'] : []; // Handle video URLs as array

    // Handle file upload for photos
    $uploaded_image_paths = [];
    if (isset($_FILES['photos'])) {
        $total_files = count($_FILES['photos']['name']);
        for ($i = 0; $i < $total_files; $i++) {
            $file_name = $_FILES['photos']['name'][$i];
            $file_tmp = $_FILES['photos']['tmp_name'][$i];
            if (move_uploaded_file($file_tmp, '../uploads/daywise/' . $file_name)) {
                $uploaded_image_paths[] = '../uploads/daywise/' . $file_name;
            }
        }
    }

    // Convert arrays to comma-separated strings for storage
    $image_paths = implode(',', $uploaded_image_paths);
    $video_urls_string = implode(',', $video_urls);

    // Insert data into cropdaywise table
    $sql = "INSERT INTO cropdaywise (crop_id, crop_name, duration, day_no, day_description, notes, vanaspati_stage, work, spray_drenching, worker_count, photos, video_urls)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('isisssssiiss', $crop_id, $crop_name, $duration, $day_no, $day_description, $notes, $vanaspati_stage, $work, $spray_drenching, $worker_count, $image_paths, $video_urls_string);
        
        if ($stmt->execute()) {
            // Redirect to crodaywise report page
            header('Location:../view/CropDaywise_report.php'); // Change to your actual report page path
            exit; // Ensure that no further code is executed
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Error in preparing the statement: " . $conn->error;
    }

    // Send data to external API using cURL
    $data = [
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
        "photos" => $uploaded_image_paths, // Send array of photos
        "video_urls" => $video_urls // Send array of video URLs
    ];

    $curl = curl_init();
    
    curl_setopt_array($curl, [
        CURLOPT_URL => 'http://localhost/CropManageSystem/Routes/dewise.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    ]);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        echo 'cURL error: ' . curl_error($curl);
    } else {
        echo $response;
    }

    curl_close($curl);

    // Close the database connection
    $conn->close();
}
?>
