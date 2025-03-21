<?php
// @session_start();
include "../configuration/config.php";

// Initialize cURL
$curl = curl_init();

// Get ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Validate ID
if ($id <= 0) {
    die("Invalid ID");
}

// Set cURL options
curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost/CropManageSystem/Routes/getAll_terms.php?id=' . $id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTPHEADER => array(
        'Cookie: PHPSESSID=42kshde3ofcapa6g3v9ieeaqap'
    ),
));

// Execute cURL request and get the response
$response = curl_exec($curl);

// Check for cURL errors
if (curl_errno($curl)) {
    echo 'cURL Error: ' . curl_error($curl);
    exit;
}

// Close cURL session
curl_close($curl);

// Decode JSON response
$data = json_decode($response, true);

// Check if the response contains data
$record = is_array($data) && isset($data[0]) ? $data[0] : null;

// Include header
include "../configuration/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
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

<main class="main-content">
    <div class="page-content">
        <div class="page-header">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between" style="padding: 10px;">
                <h5 class="mb-sm-0 custom-heading">Terms and Conditions</h5>
            </div>
        </div>
        <div class="card" style="margin:10px">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Terms</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <?php if ($record): ?>
                        <h4>Terms</h4>
                        <p><?php echo htmlspecialchars_decode(htmlspecialchars($record['terms'])); ?></p>
                    <?php else: ?>
                        <p>No details found.</p>
                    <?php endif; ?>
                    <a href="terms_report.php" class="btn btn-primary back-button">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "../configuration/footer.php"; ?>
</body>
</html>
