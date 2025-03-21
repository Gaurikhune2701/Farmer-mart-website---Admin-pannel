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
    CURLOPT_URL => 'http://localhost/CropManageSystem/Routes/getAll_about.php?id=' . $id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Cookie: PHPSESSID=42kshde3ofcapa6g3v9ieeaqap'
    ),
));

// Execute cURL request and get the response
$response = curl_exec($curl);

// Check for cURL errors
if (curl_errno($curl)) {
    echo '<div class="error-message">cURL Error: ' . curl_error($curl) . '</div>';
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
    <title>FAQ Report</title>
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
                            <h5 class="mb-sm-0 custom-heading">About Us - Details</h5>
                        </div>
                </div>
                <div class="card" style="margin:10px">
                <div class="card-header d-flex justify-content-between align-items-center">
                <h5>About</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <!-- <div class="loader" id="loader">Loading...</div> -->
                    <?php if ($record): ?>
                        <h4>About Us</h4>
                        <?php
                        $aboutText = htmlspecialchars($record['about']);
                        $maxLength = 254;
                        if (strlen($aboutText) > $maxLength) {
                            $truncatedText = substr($aboutText, 0, $maxLength) . '... <span id="see-more-btn" class="see-more-btn">Read More</span>';
                            $fullText = $aboutText;
                        } else {
                            $truncatedText = $aboutText;
                            $fullText = '';
                        }
                        ?>
                        <p id="text-container" class="text-container"><?php echo $truncatedText; ?></p>
                        <p id="full-text" class="full-text text-container"><?php echo $fullText; ?></p>
                        <a href="aboutUs_report.php" class="btn btn-primary  back-button">Back to List</a>
                    <?php else: ?>
                        <p>No details found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var seeMoreButton = document.getElementById('see-more-btn');
        var textContainer = document.getElementById('text-container');
        var fullText = document.getElementById('full-text');
        var loader = document.getElementById('loader');

        // Show loader while content is loading
        loader.style.display = 'block';

        if (seeMoreButton) {
            seeMoreButton.addEventListener('click', function() {
                textContainer.style.display = 'none';
                fullText.style.display = 'block';
                loader.style.display = 'none'; // Hide loader when content is fully displayed
            });
        } else {
            loader.style.display = 'none'; // Hide loader if no "Read More" button
        }
    });
</script>

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

<?php include "../configuration/footer.php"; ?>
