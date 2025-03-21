<?php
@session_start();
include "../configuration/header.php";
include "../configuration/config.php";
?>

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

<main class="main-content">
    <div class="page-content">
        <div class="page-header">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent" style="padding:10px">
                <h5 class="mb-sm-0 custom-heading">Banner Report</h5>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">Banner Report</li>
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
                        <h5>Banner Report</h5>
                        <div>
                            <a href="addBanner.php" class="btn btn-primary">Add New</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                                <thead class=" table table-responsive table-light">
                                    <tr>
                                        <th scope="col">Sr.No</th>
                                        <th scope="col">Banner Image</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $curl = curl_init();
                                    
                                    curl_setopt_array($curl, array(
                                      CURLOPT_URL => $base_url . '/Routes/fetch_allBanner.php',
                                      CURLOPT_RETURNTRANSFER => true,
                                      CURLOPT_ENCODING => '',
                                      CURLOPT_MAXREDIRS => 10,
                                      CURLOPT_TIMEOUT => 0,
                                      CURLOPT_FOLLOWLOCATION => true,
                                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                      CURLOPT_CUSTOMREQUEST => 'GET',
                                      CURLOPT_HTTPHEADER => array(
                                        'Cookie: PHPSESSID=68pi8kleqj4q94cdaqj45v4300'                                      ),
                                    ));
                                    
                                    $response = curl_exec($curl);
                                    
                                    if (curl_errno($curl)) {
                                        echo 'Error:' . curl_error($curl);
                                    } else {
                                        $data = json_decode($response, true);
                                        if ($data['status'] === 'success') {
                                            foreach ($data['data'] as $banner) {
                                                // Split image paths if multiple images are stored
                                                // $images = explode(',', $category['image']);
                                                $image = $banner['image'];
                                                $image_html = '';
                                                // foreach ($images as $image) {
                                                    $image_html = "<img src='$image' alt='' style='height:50px; width:50px;'>";
                                                // }
                                                echo "<tr>
                                                        <td>{$banner['sr_no']}</td>
                                                        <td>{$image_html}</td>
                                                        <td>{$banner['description']}</td>
                                                        <td>
                                                            <a href='view_singleBannerReport.php?sr_no={$banner['sr_no']}' class='btn btn-success'>View</a>
                                                            <a href='edit_banner.php?sr_no={$banner['sr_no']}' class='btn btn-warning'>Update</a>
                                                            <a href='../Controller/check_deleteBanner.php?sr_no={$banner['sr_no']}' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a>
                                                        </td>
                                                      </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='6'>No banners found.</td></tr>";
                                        }
                                    }
                                    
                                    curl_close($curl);
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

<?php include "../configuration/footer.php"; ?>
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

<script src="../View/assets/js/pages/datatables.init.js"></script>
</body>
</html>
