<?php
session_start();
include '../configuration/config.php';

$id = isset($_GET['ticket_id']) ? intval($_GET['ticket_id']) : 0;

if ($id > 0) {
    $sql = "SELECT * FROM ticket WHERE ticket_id = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $ticket = mysqli_fetch_assoc($result);

        header('Content-Type: application/json');
        echo json_encode($ticket);
    } else {
        header('Content-Type: application/json');
        echo json_encode([]);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode([]);
}

mysqli_close($conn);
?>
