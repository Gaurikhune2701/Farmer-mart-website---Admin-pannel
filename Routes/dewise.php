<?php
include '../configuration/config.php';

// Get JSON input data
$data = json_decode(file_get_contents('php://input'), true);

// Debugging: Log the entire POST data
error_log(print_r($data, true)); // This will log to your PHP error log

// Retrieve posted data
$crop_name = isset($data['crop_name']) ? $data['crop_name'] : '';
$duration = isset($data['duration']) ? $data['duration'] : '';
$day_no = isset($data['day_no']) ? $data['day_no'] : '';
$day_description = isset($data['day_description']) ? $data['day_description'] : '';
$notes = isset($data['notes']) ? $data['notes'] : '';
$vanaspati_stage = isset($data['vanaspati_stage']) ? $data['vanaspati_stage'] : '';
$work = isset($data['work']) ? $data['work'] : '';
$spray_drenching = isset($data['spray_drenching']) ? $data['spray_drenching'] : '';
$worker_count = isset($data['worker_count']) ? $data['worker_count'] : '';
$image_paths = isset($data['photos']) ? json_encode($data['photos']) : ''; // Store as JSON
$video_urls = isset($data['video_urls']) ? json_encode($data['video_urls']) : '';

// Validate inputs
if (empty($crop_name) || empty($duration) || empty($day_no) || empty($day_description)) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Required fields are missing!']);
    exit();
}

// Prepare and execute the SQL query to insert data
$insert_sql = "INSERT INTO Cropdaywise (crop_name, duration, day_no, day_description, notes, vanaspati_stage, work, spray_drenching, worker_count, photos, video_urls) 
               VALUES ('$crop_name', '$duration', '$day_no', '$day_description', '$notes', '$vanaspati_stage', '$work', '$spray_drenching', '$worker_count', '$image_paths', '$video_urls')";

if (mysqli_query($conn, $insert_sql)) {
    // If the insert is successful
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'Data created successfully', 'crop_name' => $crop_name]);
} else {
    // If there is a query failure
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Data failed to be inserted!', 'error' => mysqli_error($conn)]);
}

// Close the database connection
mysqli_close($conn);
?>
