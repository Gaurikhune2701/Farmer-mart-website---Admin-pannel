<?php
// @session_start();
include '../configuration/header.php';
include '../configuration/config.php';

// Initialize cURL
$curl = curl_init();

// Fetch settings data from the specified URL
curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost/CropManageSystem/Routes/settingList.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Cookie: PHPSESSID=189gp2huadkvh5qcqt8v1srnum'
      ),
    ));
    
// Execute cURL request and fetch the response
$response = curl_exec($curl);

if ($response === false) {
    echo 'cURL Error: ' . curl_error($curl);
    curl_close($curl);
    exit; // Exit if there's an error
}

curl_close($curl);

// Decode the JSON response
$data = json_decode($response, true);
?>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" />
<script src="../view/assets/js/alert_timeout.js"></script>

<style>
    label {
        font-size: 14px;
        font-weight: bold;
        color: black;
    }
    
    .button-container {
        display: flex;
        /* justify-content: flex-end; */
       
    }

    .custom-heading {
        padding-left: 3px;
        margin-left: 10px;
    }
</style>

<main class="main-content">
    <div class="page-content">
        <div class="page-header">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent" style="padding:10px">
                <h5 class="mb-sm-0 custom-heading">Settings</h5>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
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
                        <h5>Settings</h5>
                        <!-- <div>
                            <a href="setting.php" class="btn btn-primary">Add New</a>
                        </div> -->
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Sr.No</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">App Logo</th>
                                        <th scope="col">App Name</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Website</th>
                                        <th scope="col">Copyrights</th>
                                        <th scope="col">Facebook Link</th>
                                        <th scope="col">Whatsapp Link</th>
                                        <th scope="col">Twitter Link</th>
                                        <th scope="col">LinkedIn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($data)) : ?>
                                        <?php foreach ($data as $index => $row) : ?>
                                            <tr>
                                                <td><?php echo $index + 1; ?></td>
                                                <td class="text-center">
                                                    <div class="button-container">
                                                        <a href="view_Setting.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-success">View</a>
                                                        <a href="UpdateSetting_ById.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-warning" style="margin-left:4px">Update</a>
                                                        <a href="delete_Setting.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-danger" style="margin-left:4px" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img src="<?php echo !empty($row['photos']) ? htmlspecialchars($row['photos'], ENT_QUOTES, 'UTF-8') : 'path/to/placeholder.png'; ?>" alt="App Logo" style="max-width:60px;max-height: 60px;">
                                                </td>
                                                <td><?php echo htmlspecialchars($row['app_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($row['contact_no'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($row['email_id'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><a href="<?php echo htmlspecialchars($row['website'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank"><?php echo htmlspecialchars($row['website'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                                                <td><?php echo htmlspecialchars($row['copyrights'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><a href="<?php echo htmlspecialchars($row['facebook_link'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank"><?php echo htmlspecialchars($row['facebook_link'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                                                <td><a href="<?php echo htmlspecialchars($row['whatsapp_link'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank"><?php echo htmlspecialchars($row['whatsapp_link'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                                                <td><a href="<?php echo htmlspecialchars($row['twitter_link'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank"><?php echo htmlspecialchars($row['twitter_link'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                                                <td><a href="<?php echo htmlspecialchars($row['linkedin'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank"><?php echo htmlspecialchars($row['linkedin'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="12" class="text-center">No data available</td>
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

<?php include '../configuration/footer.php'; ?>

<!-- jQuery and DataTables scripts -->
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

<script>
$(document).ready(function() {
    $('#buttons-datatables').DataTable({
        responsive: true,
        lengthMenu: [10, 25, 50, 100],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
</script>
