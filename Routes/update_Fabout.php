<?php
// include '../configuration/header.php';
include '../configuration/config.php';

// Fetch the ID from the query string
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the existing data
$existing_about = ''; // Initialize the variable to avoid undefined variable errors
if ($id > 0) {
    $query = "SELECT * FROM tbl_about WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $existing_about = $row['about'];
    } else {
        echo "No record found";
        exit;
    }
} else {
    echo "Invalid ID";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $about = $_POST['about'];

    // Escape the content to prevent SQL injection
    $about = mysqli_real_escape_string($conn, $about);

    $update_query = "UPDATE tbl_about SET about = '$about' WHERE id = $id";

    if (mysqli_query($conn, $update_query)) {
        $_SESSION['success_status'] = 'About updated successfully!';

        // Redirect to the "About Us" report page with a success message
        header('Location: ../view/aboutUs_report.php?updated=true');
        exit;
    } else {
        // Debugging: Output SQL error
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
// include '../configuration/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update About Us</title>
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


<?php include '../configuration/header.php';?>

<main class="main-content">

<div class="page-content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h5 class="mb-sm-0">Update About Us</h5>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Update About Us</li>
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
                        <h4 class="card-title mb-0">Update About Us</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <textarea name="about" id="about" rows="10" class="form-control"><?php echo htmlspecialchars($existing_about); ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container-fluid -->
</main><!-- end main-content -->

<!-- Initialize CKEditor -->
<script>
    CKEDITOR.replace('about');
</script>
<?php
include '../configuration/footer.php';
?>

</body>
</html>
