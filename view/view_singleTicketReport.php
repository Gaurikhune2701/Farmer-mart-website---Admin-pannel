<?php
// @session_start();
include "../configuration/header.php";
include "../configuration/config.php";
?>

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

<main class="main-content">
    <div class="page-content">
        <div class="page-header">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent" style="padding:10px">
                <h5 class="mb-sm-0 custom-heading">View Ticket</h5>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">View Ticket</li>
                    </ol>
                </div>
            </div>

            <div class="table-content table-basic">
                <div class="card" style="margin:10px">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Ticket Details</h5>
                        <div>
                            <a href="ticketReport.php" class="btn btn-primary">
                                Ticket Report
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                                <thead class="table table-responsive table-light">
                                    <tr>
                                        <th scope="col">Fields</th>
                                        <th scope="col">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id = $_GET['ticket_id'] ?? '';

                                    $curl = curl_init();

                                    curl_setopt_array($curl, array(
                                        CURLOPT_URL => $base_url . '/Routes/fetch_ticket.php?ticket_id=' . $id,
                                        CURLOPT_RETURNTRANSFER => true,
                                        CURLOPT_ENCODING => '',
                                        CURLOPT_MAXREDIRS => 10,
                                        CURLOPT_TIMEOUT => 0,
                                        CURLOPT_FOLLOWLOCATION => true,
                                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                        CURLOPT_CUSTOMREQUEST => 'GET',
                                        CURLOPT_HTTPHEADER => array(
                                            'Cookie: PHPSESSID=q96nf2p41gsmm3kc8ql1orv1l9'
                                        ),
                                    ));

                                    $response = curl_exec($curl);
                                    curl_close($curl);

                                    if (curl_errno($curl)) {
                                        echo 'Error: ' . curl_error($curl);
                                    } else {
                                        $data = json_decode($response, true);
                                        // print_r($data);

                                        if (isset($data['ticket_id']) && !empty($data['ticket_id'])) {
                                            echo "<tr><td>Ticket ID</td><td>{$data['ticket_id']}</td></tr>";
                                            echo "<tr><td>Title</td><td>{$data['title']}</td></tr>";
                                            echo "<tr><td>Customer Name</td><td>{$data['customer_name']}</td></tr>";
                                            echo "<tr><td>Description</td><td>{$data['description']}</td></tr>";
                                            echo "<tr><td>Assign To</td><td>{$data['assign_to']}</td></tr>";
                                            echo "<tr><td>Created At</td><td>" . date('d-m-Y', strtotime($data['created_at'])) . "</td></tr>";
                                            echo "<tr><td>Due Date</td><td>" . date('d-m-Y', strtotime($data['due_date'])) . "</td></tr>";
                                            echo "<tr><td>Status</td><td>{$data['status']}</td></tr>";
                                            echo "<tr><td>Priority</td><td>{$data['priority']}</td></tr>";
                                            // echo "<tr><td>Action</td><td><a href='ticketReport.php' class='btn btn-danger'>Cancel</a></td></tr>";
                                        } else {
                                            echo "<tr><td colspan='2'>No tickets found.</td></tr>";
                                        }
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
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> -->

<script src="../View/assets/js/pages/datatables.init.js"></script>
</body>
</html>
