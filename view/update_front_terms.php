<?php 
// @session_start();

//include '../configuration/header.php';
include '../configuration/config.php'; 



// Fetch existing terms and conditions
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = "SELECT * FROM tbl_terms WHERE id = $id";
$result = mysqli_query($conn, $query);
$terms = '';
if ($result && mysqli_num_rows($result) > 0) {
    $terms = mysqli_fetch_assoc($result)['terms'];
} else {
    // Redirect if the ID is not valid
    $_SESSION['error_status'] = 'ID is not valid.';
    header('Location:terms_report.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $terms = mysqli_real_escape_string($conn, $_POST['terms']);
    echo $updateQuery = "UPDATE tbl_terms SET terms = '$terms' WHERE id = $id";

    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['success_status'] = 'Terms has been updated successfully!';
        header('Location: terms_report.php?success=1');
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Terms and Conditions</title>
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <style>
        label {
            font-size: 14px;
            font-weight: bold;
            color: black;
        }
        .button-container {
            display: flex;
            justify-content: flex-end;
        }
        .custom-heading {
            padding-left: 3px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
<?php include '../configuration/header.php';
?>
<main class="main-content">
    <!-- Start main content -->
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h5 class="mb-sm-0">Update Terms And Conditions</h5>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Update Terms And Conditions</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0">Update Terms and Conditions</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <!-- Form for submitting editor content -->
                            <form action="update_front_terms.php?id=<?php echo $id; ?>" method="post">
                                <textarea class="ckeditor-classic" name="terms" id="terms"><?php echo htmlspecialchars($terms); ?></textarea>
                                <br>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container-fluid -->
    </div><!-- end page-content -->
</main><!-- end main-content -->

<!-- Initialize CKEditor -->
<script>
    CKEDITOR.replace('terms');
</script>


 <?php include '../configuration/footer.php'; ?>
</body>
</html>
