<?php
// session_start();

include '../configuration/config.php';

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (json_last_error() === JSON_ERROR_NONE && !empty($data)) {
    $id = $data['id'] ?? '';
    $crop_name = $data['crop_name'] ?? '';
    $crop_type = $data['crop_type'] ?? '';
    $category = $data['category'] ?? '';
    $season = $data['season'] ?? '';
    $climate = $data['climate'] ?? '';
    $soil = $data['soil'] ?? '';
    $varieties_recommended = $data['varieties_recommended'] ?? '';
    $land = $data['land'] ?? '';
    $fertilizer = $data['fertilizer'] ?? '';
    $irrigation = $data['irrigation'] ?? '';
    $weed_control = $data['weed_control'] ?? '';
    $harvesting = $data['harvesting'] ?? '';
    $post_harvest = $data['post_harvest'] ?? '';
    $category2 = $data['category2'] ?? '';
    $duration = $data['duration'] ?? '';
    $intro = $data['intro'] ?? '';
    $videolinks = $data['videolinks'] ?? '';
    $statuss = $data['statuss'] ?? '';
    $image = $data['photos'] ?? '';

    // SQL update query
    $sql = "UPDATE crop_management SET 
                crop_name = '$crop_name', 
                crop_type = '$crop_type', 
                category = '$category', 
                season = '$season', 
                climate = '$climate', 
                soil = '$soil', 
                varieties_recommended = '$varieties_recommended', 
                land = '$land', 
                fertilizer = '$fertilizer', 
                irrigation = '$irrigation', 
                weed_control = '$weed_control', 
                harvesting = '$harvesting', 
                post_harvest = '$post_harvest', 
                category2 = '$category2', 
                duration = '$duration', 
                intro = '$intro', 
                videolinks = '$videolinks', 
                photos = '$image', 
                statuss = '$statuss' 
            WHERE id = '$id'";

    // Use prepared statements to prevent SQL injection
    if ($stmt = mysqli_prepare($conn, $sql)) {
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(["status" => "success", "message" => "Crop updated successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error updating crop: " . mysqli_error($conn)]);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(["status" => "error", "message" => "SQL prepare error: " . mysqli_error($conn)]);
    }

    mysqli_close($conn);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid or missing JSON data."]);
}
?>
