<?php
include '../configuration/config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['sr_no']) && !empty($data['sr_no'])) {
        $sr_no = $data['sr_no'];

        $sql = "DELETE FROM banner WHERE `sr_no` = $sr_no";

        if ($conn->query($sql) === TRUE) {
            if ($conn->affected_rows > 0) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'banner deleted successfully.',
                    'sr_no' => $sr_no
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'banner not found or already deleted.'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to delete the banner. Try again later.'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'No sr_no provided or sr_no is empty.'
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
