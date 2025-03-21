<?php
@session_start();
include "../configuration/header.php";
include "../configuration/config.php";
?>

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
                <h5 class="mb-sm-0 custom-heading">User Report</h5>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">User Report</li>
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
                        <h5>User Report</h5>
                        <div>
                            <a href="addUser.php" class="btn btn-primary">
                            Add New
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Designation</th>
                                        <th scope="col">Mobile No.</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $curl = curl_init();

                                    curl_setopt_array($curl, array(
                                        CURLOPT_URL => $base_url . '/Routes/fetch_allUser.php',
                                        CURLOPT_RETURNTRANSFER => true,
                                        CURLOPT_ENCODING => '',
                                        CURLOPT_MAXREDIRS => 10,
                                        CURLOPT_TIMEOUT => 0,
                                        CURLOPT_FOLLOWLOCATION => true,
                                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                        CURLOPT_CUSTOMREQUEST => 'GET',
                                    ));

                                    $response = curl_exec($curl);

                                    curl_close($curl);

                                    $users = json_decode($response, true);

                                    if (!empty($users)) {
                                        foreach ($users as $user) {
                                            echo "<tr>";
                                            echo "<td>{$user['id']}</td>";
                                            echo "<td>{$user['full_name']}</td>";
                                            echo "<td>{$user['designation']}</td>";
                                            echo "<td>{$user['mobileNo']}</td>";
                                            echo "<td>{$user['email']}</td>";
                                            echo "<td>
                                                <a href='view_singleUserReport.php?id={$user['id']}' class='btn btn-success'>View</a>
                                                <a href='edit_user.php?id={$user['id']}' class='btn btn-warning'>Update</a>
                                                <a href='../Controller/check_deleteUser.php?id={$user['id']}' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a>
                                                </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center'>No Users Found</td></tr>";
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