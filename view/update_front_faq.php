<?php
include '../configuration/config.php'; 

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect updated form data
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $answer = mysqli_real_escape_string($conn, $_POST['answer']);

    // Update the database with new values
    $updateQuery = "UPDATE tbl_faq SET question = '$question', answer = '$answer' WHERE id = $id";
    
    if (mysqli_query($conn, $updateQuery)) {
        // Set a session message
        $_SESSION['success_status'] = 'FAQ has been updated successfully!';
        header('Location: FAQ_report.php'); // Redirect to the FAQ list page
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

} else {
    // Fetch the current values
    $query = "SELECT * FROM tbl_faq WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $faq = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update FAQ</title>
</head>
<body>
<?php
include '../configuration/header.php'; 
?>


<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h5 class="mb-sm-0">Update FAQ</h5>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Update FAQ</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End page title -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h3 class="card-title mb-0 flex-grow-1">Update FAQ</h3>
                            <a class="btn btn-primary" href="FAQ_report.php">FAQ Report</a>
                        </div><!-- End card header -->

                        <div class="card-body">
                            <div class="live-preview">
                                <form method="post" action="">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="question" class="form-label">Question: <span style="color: red;">*</span></label>
                                                <input type="text" id="question" name="question" class="form-control" value="<?php echo htmlspecialchars($faq['question']); ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="answer" class="form-label">Answer: <span style="color: red;">*</span></label>
                                                <textarea id="answer" name="answer" class="form-control" required><?php echo htmlspecialchars($faq['answer']); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="text-front mb-3">
                                            <button type="submit" class="btn btn-primary" onclick="window.location.href='FAQ_report.php';">Update FAQ</button>
                                        </div>
                                    </div><!-- End row -->
                                </form>
                            </div><!-- End live preview -->
                        </div><!-- End card body -->
                    </div><!-- End card -->
                </div><!-- End col -->
            </div><!-- End row -->
        </div><!-- End container-fluid -->
    </div><!-- End page-content -->
</div><!-- End main-content -->
<?php
include '../configuration/config.php'; ?>
</body>
</html>
