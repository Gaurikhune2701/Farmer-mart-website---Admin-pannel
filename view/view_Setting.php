<?php
// @session_start();
include '../configuration/header.php';
include '../configuration/config.php';

// Get the ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Check if ID is valid
if ($id <= 0) {
    echo 'Invalid ID.';
    include "footer.php";
    exit;
}

// Initialize cURL
$curl = curl_init();

// Prepare the POST data
$postData = json_encode(array('id' => $id));

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost/CropManageSystem/Routes/getById_setting.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT =>0, // Set a reasonable timeout
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Cookie: PHPSESSID=189gp2huadkvh5qcqt8v1srnum'
      ),
    ));

// Execute cURL request and fetch the response
$response = curl_exec($curl);

if ($response === false) {
    echo 'cURL Error: ' . curl_error($curl);
    curl_close($curl);
    include "footer.php";
    exit;
}

curl_close($curl);

// Decode the JSON response
$data = json_decode($response, true);

// Debugging: Uncomment this to see the raw response and decoded data
/*
echo '<pre>';
print_r($response); // Raw response
print_r($data); // Decoded data
echo '</pre>';
*/

// Check if the data is valid
if (empty($data) || !isset($data[0])) {
    echo 'No data found for the given ID.';
    include "footer.php";
    exit;
}

// Extract the first item from the data
$settingData = $data[0];
?>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" />

<style>
  label {
      font-size: 14px;
      font-weight: bold;
      color: black;
  }
  
  .view-container {
      padding: 20px;
  }

  .view-container img {
      max-width: 200px; /* Adjust as needed */
      height: auto;
  }

  .view-container table {
      width: 100%;
      border-collapse: collapse;
  }

  .view-container th, .view-container td {
      padding: 10px;
      border: 1px solid #ddd;
  }

  .view-container th {
      background-color: #f4f4f4;
  }
</style>

<main class="main-content">
    <div class="page-content">
        <div class="page-header">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent" style="padding:10px">
                <h5 class="mb-sm-0 custom-heading ms-2">View Setting</h5>
            </div>
            
            <div class="view-container">
                <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Setting Details</h5>
                        <div>
                            <a href="SettingReport.php" class="btn btn-primary">
                            Setting Report
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <table>
                            <tr>
                                <th>App Logo</th>
                                <td>
                                    <?php if (!empty($settingData['photos'])): ?>
                                        <img src="<?php echo htmlspecialchars($settingData['photos'], ENT_QUOTES, 'UTF-8'); ?>" alt="App Logo">
                                    <?php else: ?>
                                        <img src="path/to/default/image.png" alt="Default Logo">
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>App Name</th>
                                <td><?php echo htmlspecialchars($settingData['app_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                            </tr>
                            <tr>
                                <th>Contact</th>
                                <td><?php echo htmlspecialchars($settingData['contact_no'], ENT_QUOTES, 'UTF-8'); ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo htmlspecialchars($settingData['email_id'], ENT_QUOTES, 'UTF-8'); ?></td>
                            </tr>
                            <tr>
                                <th>Website</th>
                                <td><a href="<?php echo htmlspecialchars($settingData['website'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank"><?php echo htmlspecialchars($settingData['website'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                            </tr>
                            <tr>
                                <th>Copyrights</th>
                                <td><?php echo htmlspecialchars($settingData['copyrights'], ENT_QUOTES, 'UTF-8'); ?></td>
                            </tr>
                            <tr>
                                <th>Facebook Link</th>
                                <td><a href="<?php echo htmlspecialchars($settingData['facebook_link'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank"><?php echo htmlspecialchars($settingData['facebook_link'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                            </tr>
                            <tr>
                                <th>Whatsapp Link</th>
                                <td><a href="<?php echo htmlspecialchars($settingData['whatsapp_link'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank"><?php echo htmlspecialchars($settingData['whatsapp_link'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                            </tr>
                            <tr>
                                <th>Twitter Link</th>
                                <td><a href="<?php echo htmlspecialchars($settingData['twitter_link'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank"><?php echo htmlspecialchars($settingData['twitter_link'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                            </tr>
                            <tr>
                                <th>LinkedIn</th>
                                <td><a href="<?php echo htmlspecialchars($settingData['linkedin'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank"><?php echo htmlspecialchars($settingData['linkedin'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include '../configuration/footer.php';?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
