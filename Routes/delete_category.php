<?php
include '../configuration/config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['sr.no']) && !empty($data['sr.no'])) {
        $sr_no = $data['sr.no'];

        $sql = "DELETE FROM crop_category WHERE `sr.no` = $sr_no";

        if ($conn->query($sql) === TRUE) {
            if ($conn->affected_rows > 0) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'category deleted successfully.',
                    'sr.no' => $sr_no
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'crop category not found or already deleted.'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to delete the category. Try again later.'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'No sr.no provided or sr.no is empty.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method. Use DELETE.'
    ]);
}

$conn->close();
?>
