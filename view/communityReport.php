<?php
// @session_start();
include "../configuration/header.php";
include '../configuration/config.php'; 
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
      margin-bottom: 10px;
  }

  .custom-heading {
      padding-left: 3px;
      margin-left: 10px;
  }

  .table-img, .table-video {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 5px;
  }

  .page-header {
      margin-bottom: 20px;
  }

  .card {
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  }

  .card-header {
      background-color: #f8f9fa;
  }

  .table-responsive {
      margin-top: 10px;
  }

  .table th, .table td {
      text-align: center;
      vertical-align: middle;
  }

  .dropdown-action {
      cursor: pointer;
  }
</style>

<main class="main-content">
    <!-- start main content -->
    <div class="page-content">
        <div class="page-header">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent" style="padding:10px">
                <h5 class="mb-sm-0 custom-heading">Community Report</h5>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">Community Report</li>
                    </ol>
                </div>
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
                    <h5>Community Report</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="display table table-bordered table-striped" style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th>Sr No</th>
                                    <th>Customer Name</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Video</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $curl = curl_init();
                                    
                                curl_setopt_array($curl, array(
                                    CURLOPT_URL => $base_url . '/Routes/fetch_allCommunity.php',
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => '',
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 0,
                                    CURLOPT_FOLLOWLOCATION => true,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => 'GET',
                                    CURLOPT_HTTPHEADER => array(
                                        'Cookie: PHPSESSID=68pi8kleqj4q94cdaqj45v4300'                                    
                                    ),
                                ));
                                    
                                $response = curl_exec($curl);
                                    
                                if (curl_errno($curl)) {
                                    echo 'Error:' . curl_error($curl);
                                } else {
                                    $data = json_decode($response, true);
                                    if ($data['status'] === 'success') {
                                        foreach ($data['data'] as $community) {
                                            $image = $community['image'];
                                            if(!empty($image)) {
                                                $image_html = '';
                                                $image_html = "<img src='$image' alt='' style='height:50px; width:50px;'>";
                                            } else {
                                                $image_html = 'No Image';
                                            }
                                            
                                            $video = $community['video'];
                                            if(!empty($video)){
                                            $video_html = "<a href='$video' target='_blank'>Play Video</a>";
                                            } else {
                                                $video_html = 'No Video';
                                            }
                                            
                                            $status = $community['status'];

                                                echo "<tr>
                                                    <td>{$community['sr_no']}</td>
                                                    <td>{$community['customer_name']}</td>
                                                    <td>{$community['title']}</td>
                                                    <td>{$community['description']}</td>
                                                    <td>{$image_html}</td>
                                                    <td>{$video_html}</td>
                                                    <td>{$status}</td>
                                                    <td>
                                                        <form method='POST' action='../Routes/update_communityStatus.php'>
                                                            <input type='hidden' name='sr_no' value='{$community['sr_no']}'>
                                                            <select name='status' class='form-select' onchange='this.form.submit()'>
                                                                <option value='' disabled selected>Select a Status</option>
                                                                <option value='Active'>Active</option>
                                                                <option value='Block'>Block</option>
                                                            </select>
                                                        </form>
                                                    </td>                           
                                                </tr>";
                                        }
                                    } else {
                                            echo "<tr><td colspan='6'>No communities found.</td></tr>";
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
</main>

<?php include "../configuration/footer.php"; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
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
