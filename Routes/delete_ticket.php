<?php
include '../configuration/config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['ticket_id']) && !empty($data['ticket_id'])) {
        $ticket_id = $data['ticket_id'];

        $sql = "DELETE FROM ticket WHERE ticket_id = $ticket_id";

        if ($conn->query($sql) === TRUE) {
            if ($conn->affected_rows > 0) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Ticket deleted successfully.',
                    'ticket_id' => $ticket_id
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Ticket not found or already deleted.'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to delete the ticket. Try again later.'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'No ticket_id provided or ticket_id is empty.'
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
