<?php
// @session_start();
include '../configuration/header.php';
include '../configuration/config.php';

// Fetch crop data
$url = $base_url . '/Routes/CropList.php';
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
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

$response = curl_exec($curl);
curl_close($curl);
$data = json_decode($response, true);
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
                <div class="card" style="margin:10px">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Crop Report</h5>
                        <div>
                            <a href="../view/CropManagement.php" class="btn btn-primary">Add Crop</a>
                        </div>
                    </div>

                   
                        <?php if (isset($_SESSION['success_status'])) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
                                <strong>Hey!</strong> <?php echo $_SESSION['success_status']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php elseif (isset($_SESSION['error_status'])) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
                                <strong>Sorry!</strong> <?php echo $_SESSION['error_status']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <?php unset($_SESSION['success_status']);
                        unset($_SESSION['error_status']); ?>

<div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Sr.No</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">Crop Name</th>
                                        <th scope="col">Introduction</th>
                                        <th scope="col">Crop Type</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Season</th>
                                        <th scope="col">Climate</th>
                                        <th scope="col">Soil</th>
                                        <th scope="col">Land</th>
                                        <th scope="col">Fertilizer</th>
                                        <th scope="col">Irrigation</th>
                                        <th scope="col">Weed Control</th>
                                        <th scope="col">Harvesting</th>
                                        <th scope="col">Post Harvest</th>
                                        <th scope="col">Varieties Recommended</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Video</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">Status</th>
                                        <!-- <th scope="col">Crop Description</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($data)) : ?>
                                        <?php foreach ($data as $row) : ?>
                                            <tr>
                                                <td class='text-center'><?php echo htmlspecialchars($row['id']); ?></td>
                                                <td class="text-center">
                                                    <div class="button-container">
                                                        <a href="../view/Cropdaywise_Description.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-sm btn-primary">Add Schedule</a>
                                                        <a href="../view/viewCrop.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-sm btn-success">View</a>
                                                        <a href="../view/updateCrop.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-sm btn-warning" style="margin-left:4px">Update</a>
                                                        <a href="../Routes/deleteCrop_details.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-danger" style="margin-left:4px" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                                    </div>
                                                </td>
                                                <td class='text-center'><?php echo htmlspecialchars($row['crop_name']); ?></td>
                                                <td class='text-center'><?php echo htmlspecialchars($row['intro']); ?></td>
                                                <td class='text-center'><?php echo htmlspecialchars($row['crop_type']); ?></td>
                                                <td class='text-center'><?php echo htmlspecialchars($row['category']); ?></td>
                                                <td class='text-center'><?php echo htmlspecialchars($row['season']); ?></td>
                                                <td class='text-center'><?php echo htmlspecialchars($row['climate']); ?></td>
                                                <td class='text-center'><?php echo htmlspecialchars($row['soil']); ?></td>
                                                <td class='text-center'><?php echo htmlspecialchars($row['land']); ?></td>
                                                <td class='text-center'><?php echo htmlspecialchars($row['fertilizer']); ?></td>
                                                <td class='text-center'><?php echo htmlspecialchars($row['irrigation']); ?></td>
                                                <td class='text-center'><?php echo htmlspecialchars($row['weed_control']); ?></td>
                                                <td class='text-center'><?php echo htmlspecialchars($row['harvesting']); ?></td>
                                                <td class='text-center'><?php echo htmlspecialchars($row['post_harvest']); ?></td>
                                                <td class='text-center'><?php echo htmlspecialchars($row['varieties_recommended']); ?></td>
                                                <td class='text-center'><?php echo htmlspecialchars($row['category2']); ?></td>
                                                <td class='text-center'>
                                                    <?php if (!empty($row['videolinks'])) : ?>
                                                        <a href="<?php echo htmlspecialchars($row['videolinks']); ?>" target="_blank">
                                                            <i class="fas fa-video"></i> Play Video
                                                        </a>
                                                    <?php else: ?>
                                                        No Video
                                                    <?php endif; ?>
                                                </td>
                                                <td class='text-center'>
                                                    <?php if (!empty($row['photos'])) : ?>
                                                        <img src="<?php echo htmlspecialchars($row['photos']); ?>" alt="Crop Image" style="max-width:60px; max-height: 60px;">
                                                    <?php else: ?>
                                                        No Image
                                                    <?php endif; ?>
                                                </td>
                                                <td class='text-center'><?php echo htmlspecialchars($row['duration']); ?></td>
                                                <td class='text-center'><?php echo htmlspecialchars($row['statuss']); ?></td>
                                                <!-- <td class='text-center'><?php echo htmlspecialchars($row['crop_description']); ?></td> -->
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan='21' class='text-center'>No Data Available</td>
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
