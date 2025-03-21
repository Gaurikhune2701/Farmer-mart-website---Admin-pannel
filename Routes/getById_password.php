<?php
include '../Configuration/config.php';

// Get the JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

// Check if the phone is provided in the input data
$phone = isset($data['mobileNo']) ? mysqli_real_escape_string($conn, $data['mobileNo']) : '';

if (!empty($phone)) {
    // Prepare the SQL query to select phone and password fields
    $sql = "SELECT `mobileNo`, `password` FROM `user` WHERE `mobileNo` = '$phone'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Fetch all results as an associative array
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            // Return the data as a JSON response
            echo json_encode($data);
        } else {
            // No data found for the given phone number
            echo json_encode(['msg' => 'No data found for the provided phone number.', 'status' => false]);
        }
    } else {
        // Query error
        echo json_encode(['msg' => 'Query error: ' . mysqli_error($conn), 'status' => false]);
    }
} else {
    // Invalid phone number provided
    echo json_encode(['msg' => 'Invalid phone number provided.', 'status' => false]);
}

// Close the database connection
mysqli_close($conn);
?>
