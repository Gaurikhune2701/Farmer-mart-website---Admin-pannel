<?php
// session_start();
include '../configuration/header.php';
include '../configuration/config.php';

// Get the ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Check if ID is valid
if ($id <= 0) {
    echo 'Invalid ID.';
    include 'footer.php';
    exit;
}

// Initialize cURL for Crop Details
$curl = curl_init();
$postData = json_encode(['id' => $id]);

curl_setopt_array($curl, [
    CURLOPT_URL => 'http://localhost/CropManageSystem/Routes/GetById_Crop.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
]);

$response = curl_exec($curl);
if ($response === false) {
    echo 'cURL Error: ' . curl_error($curl);
    curl_close($curl);
    include 'footer.php';
    exit;
}
curl_close($curl);

// Decode the JSON response
$data = json_decode($response, true);
$cropData = $data[0] ?? null;

// Initialize cURL for Crop Daywise Data
$curlDaywise = curl_init();
curl_setopt_array($curlDaywise, [
    CURLOPT_URL => 'http://localhost/CropManageSystem/Routes/getById_daywise.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode(['id' => $id]),
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
]);

// Execute cURL request and get the response
$daywiseResponse = curl_exec($curlDaywise);
if (curl_errno($curlDaywise)) {
    echo 'cURL Error: ' . curl_error($curlDaywise);
    curl_close($curlDaywise);
    exit;
}
curl_close($curlDaywise);

// Decode JSON response
$daywiseData = json_decode($daywiseResponse, true);
$record = is_array($daywiseData) && isset($daywiseData[0]) ? $daywiseData[0] : null;
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />

<style>
    label { font-size: 14px; font-weight: bold; color: black; }
    .view-container { padding: 20px; }
    .view-container table { width: 100%; border-collapse: collapse; }
    .view-container th, .view-container td { padding: 10px; border: 1px solid #ddd; }
    .view-container th { background-color: #f4f4f4; }
    .view-container img { max-width: 100px; height: auto; }
</style>

<main class="main-content">
    <div class="page-content">
        <div class="page-header">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between" style="padding:10px">
                <h5 class="mb-sm-0 custom-heading ms-4">View Crop Report</h5>
            </div>
        </div>
        <div class="view-container">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Crop Details</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($cropData): ?>
                                    <?php
                                    $fields = [
                                        'crop_name' => 'Crop Name',
                                        'crop_type' => 'Crop Type',
                                        'category' => 'Category',
                                        'season' => 'Season',
                                        'intro' => 'Introduction',
                                        'climate' => 'Climate',
                                        'soil' => 'Soil',
                                        'varieties_recommended' => 'Varieties Recommended',
                                        'land' => 'Land Preparation',
                                        'fertilizer' => 'Fertilizer',
                                        'irrigation' => 'Irrigation',
                                        'weed_control' => 'Weed Control',
                                        'harvesting' => 'Harvesting',
                                        'post_harvest' => 'Post Harvest',
                                        'videolinks' => 'Video URLs',
                                        'photos' => 'Images'
                                    ];

                                    foreach ($fields as $key => $label) {
                                        $value = htmlspecialchars($cropData[$key] ?? 'N/A');
                                        if ($key === 'photos' && !empty($value)) {
                                            $imageUrls = explode(',', $value);
                                            $imageHtml = '';
                                            foreach ($imageUrls as $url) {
                                                $imageHtml .= '<img src="' . htmlspecialchars(trim($url)) . '" alt="Crop Image" />';
                                            }
                                            echo "<tr><td>{$label}</td><td>{$imageHtml}</td></tr>";
                                        } elseif ($key === 'videolinks' && !empty($value)) {
                                            $videoUrls = explode(',', $value);
                                            $videoLinks = '';
                                            foreach ($videoUrls as $url) {
                                                $videoLinks .= "<a href='" . htmlspecialchars(trim($url)) . "' target='_blank'>Watch Video</a><br>";
                                            }
                                            echo "<tr><td>{$label}</td><td>{$videoLinks}</td></tr>";
                                        } else {
                                            echo "<tr><td>{$label}</td><td>{$value}</td></tr>";
                                        }
                                    }
                                    ?>
                                <?php else: ?>
                                    <tr><td colspan="2">No crop data found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
           <!-- CropDaywise Report -->
           <div class="card" style="margin:10px">
                <div class="card-header">
                    <h5  class="card-title">Crop Daywise Details</h5>
                    <!-- <div>
                        <a href="CropDaywise_report.php" class="btn btn-primary">Crop report</a>
                    </div> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-bordered" style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Fields</th>
                                    <th scope="col">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($record): ?>
                                    <!-- <tr><th>Sr. No</th><td><?php echo htmlspecialchars($record['id'], ENT_QUOTES, 'UTF-8'); ?></td></tr> -->
                                    <!-- <tr><th>Crop Name</th><td><?php echo htmlspecialchars($record['crop_name'], ENT_QUOTES, 'UTF-8'); ?></td></tr>
                                    <tr><th>Duration</th><td><?php echo htmlspecialchars($record['duration'], ENT_QUOTES, 'UTF-8'); ?></td></tr> -->
                                    <tr><th>Day No</th><td><?php echo htmlspecialchars($record['day_no'], ENT_QUOTES, 'UTF-8'); ?></td></tr>
                                    <tr><th>Plant Stage</th><td><?php echo htmlspecialchars($record['vanaspati_stage'], ENT_QUOTES, 'UTF-8'); ?></td></tr>
                                    <tr><th>Work</th><td><?php echo htmlspecialchars($record['work'], ENT_QUOTES, 'UTF-8'); ?></td></tr>
                                    <tr><th>Spray/Drenching</th><td><?php echo htmlspecialchars($record['spray_drenching'], ENT_QUOTES, 'UTF-8'); ?></td></tr>
                                    <tr><th>Worker Count</th><td><?php echo htmlspecialchars($record['worker_count'], ENT_QUOTES, 'UTF-8'); ?></td></tr>
                                    <tr><th>Photos</th><td>
                                        <?php
                                        if (!empty($record['photos'])) {
                                            $photos = explode(',', $record['photos']);
                                            foreach ($photos as $photo) {
                                                $photo = trim($photo);
                                                if (!empty($photo)) {
                                                    echo '<img src="' . htmlspecialchars($photo, ENT_QUOTES, 'UTF-8') . '" style="width: 100px; height: 100px; margin: 5px;" alt="Photo" />';
                                                }
                                            }
                                        } else {
                                            echo '<img src="upload/default_image.png" style="width: 100px; height: 100px; margin: 5px;" alt="Default Photo" />';
                                        }
                                        ?>
                                    </td></tr>
                                    <tr><th>Videos</th><td>
                                        <?php
                                        if (!empty($record['video_urls'])) {
                                            $videos = explode(',', $record['video_urls']);
                                            foreach ($videos as $video) {
                                                $video = trim($video);
                                                echo '<a href="' . htmlspecialchars($video, ENT_QUOTES, 'UTF-8') . '" target="_blank">Video</a><br/>';
                                            }
                                        } else {
                                            echo 'No videos available.';
                                        }
                                        ?>
                                    </td></tr>
                                    <tr><th>Daywise Description</th><td><?php echo htmlspecialchars($record['day_description'], ENT_QUOTES, 'UTF-8'); ?></td></tr>
                                    <tr><th>Notes</th><td><?php echo htmlspecialchars($record['notes'], ENT_QUOTES, 'UTF-8'); ?></td></tr>
                                <?php else: ?>
                                    <tr><td colspan="2">No record found for the specified ID.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
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
<script src="assets/js/pages/datatables.init.js"></script>

<?php include '../configuration/footer.php'; ?>
