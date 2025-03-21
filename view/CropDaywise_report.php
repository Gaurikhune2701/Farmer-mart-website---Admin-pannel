<?php
// @session_start();
include '../configuration/header.php';
include '../configuration/config.php';
?>

<!-- DataTable CSS -->
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
        gap: 10px;
    }
    .custom-heading {
        padding-left: 3px;
        margin-left: 10px;
    }
    .card {
        margin: 10px;
    }
    .dt-buttons {
        margin-bottom: 10px;
    }
    .dataTables_filter {
        margin-bottom: 10px;
    }
    .dataTables_wrapper .dataTables_paginate,
    .dataTables_wrapper .dataTables_info {
        margin-top: 10px;
    }
</style>

<main class="main-content">
    <div class="page-content">
        <div class="page-header">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent" style="padding:10px">
                <h5 class="mb-sm-0 custom-heading">Crop Report</h5>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">Crop Report</li>
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
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Crop Report</h5>
                        <!-- <div>
                            <a href="CropDaywiseDescription.php" class="btn btn-primary">Add</a>
                        </div> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Sr.No</th>
                                        <th scope="col">Actions</th>
                                        <th scope="col">Crop Name</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">Day No</th>
                                        <th scope="col">Plant Stage</th>
                                        <th scope="col">Work</th>
                                        <th scope="col">Spray/Drenching</th>
                                        <th scope="col">Worker Count</th>
                                        <th scope="col">Photo</th>
                                        <th scope="col">Video</th>
                                        <th scope="col">Daywise Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $curl = curl_init();
                                    curl_setopt_array($curl, array(
                                        CURLOPT_URL => 'http://localhost/CropManageSystem/Routes/getAll_daywise.php',
                                        CURLOPT_RETURNTRANSFER => true,
                                        CURLOPT_FOLLOWLOCATION => true,
                                        CURLOPT_HTTPHEADER => array(
                                            'Cookie: PHPSESSID=189gp2huadkvh5qcqt8v1srnum'
                                          ),
                                        ));
                                        
                                    $response = curl_exec($curl);
                                    if ($response === false) {
                                        echo "cURL Error: " . curl_error($curl);
                                        exit;
                                    }

                                    $data = json_decode($response, true);
                                    if ($data === null) {
                                        echo "JSON Decode Error: " . json_last_error_msg();
                                        exit; // Stop execution if decoding fails
                                    }
                                    curl_close($curl);

                                 
if (!empty($data)) {
    $srNo = 1;
    foreach ($data as $row) {
        ?>
      <tr>
    <td class="text-center"><?php echo $srNo++; ?></td>
    <td class="text-center">
        <div class="button-container">
            <a href="view_daywise.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-success">View</a>
            <a href="../Routes/update_Front_cropdaywise.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-warning" style="margin-left:4px">Update</a>
            <a href="../Routes/delete_daywise.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-danger" style="margin-left:4px" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
        </div>
    </td>
    <!-- <td><?php echo $crop_name; ?></td>
    <td><?php echo $duration; ?></td> -->
    <td><?php echo htmlspecialchars($row['crop_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
    <td><?php echo htmlspecialchars($row['duration'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
    <td><?php echo htmlspecialchars($row['day_no'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
    <td><?php echo htmlspecialchars($row['vanaspati_stage'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
    <td><?php echo htmlspecialchars($row['work'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
    <td><?php echo htmlspecialchars($row['spray_drenching'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
    <td><?php echo htmlspecialchars($row['worker_count'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
    <td>
        <?php if (!empty($row['photos'])): 
            $photos = explode(',', $row['photos']);
            foreach ($photos as $photo): ?>
                <img src="<?php echo htmlspecialchars($photo, ENT_QUOTES, 'UTF-8'); ?>" style="width: 100px; height: 100px; margin: 5px;" alt="Photo" />
            <?php endforeach; 
        endif; ?>
    </td>
    <td>
        <?php if (!empty($row['video_urls'])): 
            $videos = explode(',', $row['video_urls']);
            foreach ($videos as $video): ?>
                <a href="<?php echo htmlspecialchars($video, ENT_QUOTES, 'UTF-8'); ?>" target="_blank"><?php echo htmlspecialchars($video, ENT_QUOTES, 'UTF-8'); ?></a><br/>
            <?php endforeach; 
        endif; ?>
    </td>
    <td><?php echo htmlspecialchars($row['day_description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
</tr>

        <?php
    }
} else {
    echo '<tr><td colspan="12">No records found.</td></tr>';
}
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

<?php include '../configuration/footer.php'; ?>

<!-- jQuery and DataTables scripts -->
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
