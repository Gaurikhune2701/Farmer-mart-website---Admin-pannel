<?php
include '../configuration/config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM cropdaywise WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo json_encode(['msg' => 'Failed to prepare statement', 'status' => false]);
        exit;
    }

    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['msg' => 'Data Deleted Successfully!', 'status' => true]);
    } else {
        echo json_encode(['msg' => 'Data Failed to be Deleted!', 'status' => false]);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo json_encode(['msg' => 'No ID provided in the URL', 'status' => false]);
}
?>
