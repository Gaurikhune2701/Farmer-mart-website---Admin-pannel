<?php
include '../configuration/config.php';

// Read input data
$data = json_decode(file_get_contents("php://input"), true);

// Check if 'id' is set and not empty
if (isset($data['id']) && !empty($data['id'])) {
    $id = mysqli_real_escape_string($conn, $data['id']);

    // Prepare and execute SQL query
    $sql = "SELECT * FROM crop_management WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo json_encode($data);
        } else {
            echo json_encode(['msg' => 'No Data!', 'status' => false]);
        }
    } else {
        echo json_encode(['msg' => 'Query Error: ' . mysqli_error($conn), 'status' => false]);
    }
} else {
    echo json_encode(['msg' => 'id is missing or empty!', 'status' => false]);
}
?>
