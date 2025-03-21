<?php
include '../configuration/config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['id']) && !empty($data['id'])) {
        $id = $data['id'];

        $sql = "DELETE FROM blogs WHERE `id` = $id";

        if ($conn->query($sql) === TRUE) {
            if ($conn->affected_rows > 0) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'blog deleted successfully.',
                    'id' => $id
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'blog not found or already deleted.'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to delete the blog. Try again later.'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'No id provided or id is empty.'
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
