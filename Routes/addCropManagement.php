<?php
include '../configuration/config.php'; // Ensure this file contains your database connection settings

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve POST data and decode JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if the JSON data was decoded successfully
    if ($data) {
        // Sanitize and validate input data
        $crop_name = mysqli_real_escape_string($conn, $data['crop_name']);
        $crop_type = mysqli_real_escape_string($conn, $data['crop_type']);
        $category = mysqli_real_escape_string($conn, $data['category']);
        $season = mysqli_real_escape_string($conn, $data['season']);
        $category2 = mysqli_real_escape_string($conn, $data['category2']);
        $image_paths = isset($data['photos']) ? mysqli_real_escape_string($conn, $data['photos']) : ''; // Handle photos as a string
        $videoLinks = isset($data['videoLinks']) ? json_encode($data['videoLinks']) : ''; // Convert array to JSON string
        $duration = mysqli_real_escape_string($conn, $data['duration']);
        $intro = mysqli_real_escape_string($conn, $data['intro']);
        $climate = mysqli_real_escape_string($conn, $data['climate']);
        $soil = mysqli_real_escape_string($conn, $data['soil']);
        $varietiesRecommended = mysqli_real_escape_string($conn, $data['varieties_recommended']);
        $land = mysqli_real_escape_string($conn, $data['land']);
        $fertilizer = mysqli_real_escape_string($conn, $data['fertilizer']);
        $irrigation = mysqli_real_escape_string($conn, $data['irrigation']);
        $weedControl = mysqli_real_escape_string($conn, $data['weed_control']);
        $harvesting = mysqli_real_escape_string($conn, $data['harvesting']);
        $postHarvest = mysqli_real_escape_string($conn, $data['post_harvest']);
        $statuss = mysqli_real_escape_string($conn, $data['statuss']);
        $video_urls = isset($data['video_urls']) ? json_encode($data['video_urls']) : ''; // Handle video URLs as JSON

        // Construct the SQL query
        $sql = "INSERT INTO crop_management (
            crop_name, crop_type, category, season, intro, climate, soil, varieties_recommended, 
            land, fertilizer, irrigation, weed_control, harvesting, post_harvest, videoLinks, 
            category2, duration, statuss, photos
        ) VALUES (
            '$crop_name', '$crop_type', '$category', '$season', '$intro', '$climate', '$soil', 
            '$varietiesRecommended', '$land', '$fertilizer', '$irrigation', '$weedControl', 
            '$harvesting', '$postHarvest', '$videoLinks', '$category2', '$duration', '$statuss', 
            '$image_paths'
        )";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Data created successfully']);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Data failed to be inserted', 'error' => mysqli_error($conn)]);
        }
    } else {
        // Handle invalid JSON data
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Invalid JSON data']);
    }
} else {
    // Handle invalid request method
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

// Close the database connection
mysqli_close($conn);
?>
