<?php
// @session_start();
include "../configuration/header.php";
include "../configuration/config.php";

// Get ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Validate ID
if ($id <= 0) {
    die("Invalid ID");
}

// Initialize cURL
$curl = curl_init();

// Set cURL options
curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost/CropManageSystem/Routes/getById_daywise.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30, // Adjusted to 30 seconds
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST', // Use POST for sending data
    CURLOPT_POSTFIELDS => json_encode(['id' => $id]), // Pass ID as JSON payload
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json', // Adjust content type for JSON payload
    ),
));

// Execute cURL request and get the response
$response = curl_exec($curl);

// Check for cURL errors
if (curl_errno($curl)) {
    echo 'cURL Error: ' . curl_error($curl);
    curl_close($curl);
    exit;
}

// Close cURL session
curl_close($curl);

// Decode JSON response
$data = json_decode($response, true);

// Check if the response contains data
$record = is_array($data) && isset($data[0]) ? $data[0] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crop Report</title>
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
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent" style="padding:10px">
                <h5 class="mb-sm-0 custom-heading">View Crop Report</h5>
            </div>
            <div class="table-content table-basic">
                <div class="card" style="margin:10px">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>CropDaywise Report</h5>
                        <div>
                            <a href="CropDaywise_report.php" class="btn btn-primary">Crop report</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Fields</th>
                                        <th scope="col">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($record): ?>
                                        <tr>
                                            <th>Sr. No</th>
                                            <td><?php echo htmlspecialchars($record['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Crop Name</th>
                                            <td><?php echo htmlspecialchars($record['crop_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Duration</th>
                                            <td><?php echo htmlspecialchars($record['duration'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Day No</th>
                                            <td><?php echo htmlspecialchars($record['day_no'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Plant Stage</th>
                                            <td><?php echo htmlspecialchars($record['vanaspati_stage'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Work</th>
                                            <td><?php echo htmlspecialchars($record['work'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Spray/Drenching</th>
                                            <td><?php echo htmlspecialchars($record['spray_drenching'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Worker Count</th>
                                            <td><?php echo htmlspecialchars($record['worker_count'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Photos</th>
                                            <td>
                                                <?php 
                                                if (!empty($record['photos'])) {
                                                    $photos = explode(',', $record['photos']);
                                                    foreach ($photos as $photo) {
                                                        $photo = trim($photo); // Remove any extra spaces
                                                        if (!empty($photo)) { ?>
                                                            <img src="<?php echo htmlspecialchars($photo, ENT_QUOTES, 'UTF-8'); ?>" style="width: 100px; height: 100px; margin: 5px;" alt="Photo" />
                                                        <?php }
                                                    }
                                                } else {
                                                    echo '<img src="upload/default_image.png" style="width: 100px; height: 100px; margin: 5px;" alt="Default Photo" />';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Videos</th>
                                            <td>
                                                <?php 
                                                if (!empty($record['video_urls'])) {
                                                    $videos = explode(',', $record['video_urls']);
                                                    foreach ($videos as $video) {
                                                        $video = trim($video);
                                                        if (!empty($video)) { ?>
                                                            <a href="<?php echo htmlspecialchars($video, ENT_QUOTES, 'UTF-8'); ?>" target="_blank">Video</a><br/>
                                                            <?php echo htmlspecialchars($video, ENT_QUOTES, 'UTF-8'); ?>
                                                        <?php }
                                                    }
                                                } else {
                                                    echo 'No videos available.';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Daywise Description</th>
                                            <td><?php echo htmlspecialchars($record['day_description'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Notes</th>
                                            <td><?php echo htmlspecialchars($record['notes'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="2">No record found for the specified ID.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> -->

<script src="assets/js/pages/datatables.init.js"></script>

<?php include "../configuration/footer.php"; ?>
</body>
</html>
