<?php
// @session_start();
include '../configuration/config.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $answer = mysqli_real_escape_string($conn, $_POST['answer']);

    // Insert into tbl_faq
    $sql = "INSERT INTO tbl_faq (question, answer) VALUES ('$question', '$answer')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['success_status'] = 'FAQ has been added successfully.';
        header("Location: FAQ_report.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Report</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <script src="../view/assets/js/alert_timeout.js"></script>

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
<?php
include '../configuration/header.php'; ?>

<main class="main-content">
    <div class="page-content">
        <div class="page-header">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent" style="padding:10px">
                <h4 class="mb-sm-0 custom-heading">FAQ</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">FAQ</li>
                    </ol>
                </div>
            </div>

            <?php if (isset($_SESSION['success_status']) || isset($_SESSION['error_status'])): ?>
                <div id="alert-message" 
                    class="alert alert-dismissible fade show 
                    <?= isset($_SESSION['success_status']) ? 'alert-success' : 'alert-danger'; ?>" 
                    role="alert">
                    <?php if (isset($_SESSION['success_status'])): ?>
                    <?= $_SESSION['success_status'] ?>
                    <?php elseif (isset($_SESSION['error_status'])): ?>
                    <?= $_SESSION['error_status'] ?>
                    <?php endif; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['success_status']); ?>
                <?php unset($_SESSION['error_status']); ?>
            <?php endif; ?>

            <div class="table-content table-basic">
                <div class="card" style="margin:10px">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>FAQ</h5>
                        <div>
                            <button type="button" class="btn btn-primary" onclick="window.location.href='FAQ.php'">Add FAQ</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Question</th>
                                        <th scope="col">Answer</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                   include '../configuration/config.php'; // Re-include the config file for DB connection

                                    // Fetch FAQ entries
                                    $sql = "SELECT * FROM tbl_faq";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>
                                                <td>{$row['id']}</td>
                                                <td>{$row['question']}</td>
                                                <td>{$row['answer']}</td>
                                                <td><a href='update_front_faq.php?id={$row['id']}' class='btn btn-warning'>Update</a></td>
                                            </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No FAQs found</td></tr>";
                                    }

                                    mysqli_close($conn); // Close the database connection
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="assets/js/pages/datatables.init.js"></script>

<?php include '../configuration/footer.php'; ?>
</body>
</html>
