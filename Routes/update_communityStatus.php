<?php
include '../configuration/config.php';

if (isset($_POST['sr_no']) && isset($_POST['status'])) {
    $sr_no = $_POST['sr_no'];
    $status = $_POST['status'];

    $query = "UPDATE community SET status = '$status' WHERE sr_no = '$sr_no'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success_status'] = 'Status has been updated successfully.';
        // header("Location: ../View/communityReport.php?status=updated");
        echo "<script>
            window.location.href = '../View/communityReport.php';
        </script>";    
    } else {
        header("Location: ../View/communityReport.php?status=error");
    }
}
?>
