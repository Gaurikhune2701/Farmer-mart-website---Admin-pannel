<?php
// @session_start();
include "../configuration/header.php";
include "../configuration/config.php";

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
// curl_close($curl);

$ticket = json_decode($response, true);
// print_r($ticket);

$ticket_id = $ticket['ticket_id'] ?? '';
$title = $ticket['title'] ?? '';
$customer_name = $ticket['customer_name'] ?? '';
$assign_to = $ticket['assign_to'] ?? '';
$formattedDate = date('Y-m-d', strtotime($ticket['created_at']));
$due_date = $ticket['due_date'] ?? '';
$status = $ticket['status'] ?? '';
$priority = $ticket['priority'] ?? '';

?>

<main class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h5 class="mb-sm-0">Update Ticket</h5>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Update Ticket</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h3 class="card-title mb-0 flex-grow-1">Ticket Details</h3>
                            <div class="text-center">
                                <a href="ticketReport.php" class="btn btn-primary">Ticket Report</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="live-preview">
                            <form action="../Controller/check_updateTicket.php" method="POST" autocomplete="off">
    <div class="row g-3">
        <input type="hidden" name="ticket_id" id="orderId" class="form-control" placeholder="ID" value="<?php echo $ticket_id; ?>" readonly>

        <!-- <div class="col-lg-3">
            <label for="assignedto" class="form-label">Assign To</label>
            <input type="text" id="assignedto" name="assignedto" class="form-control" value="<?php echo $assign_to; ?>" required>
        </div> -->

        <div class="col-lg-3">
            <label for="duedate" class="form-label">Due Date:  <span style="color: red;">*</span></label>
            <input type="date" id="duedate" name="duedate" class="form-control" value="<?php echo $due_date; ?>" required>
        </div>

        <div class="col-lg-3">
            <label for="ticket-status" class="form-label">Status:  <span style="color: red;">*</span></label>
            <select id="ticket-status" name="ticket-status" class="form-select" required>
                <option value="" disabled>Select Status</option>
                <option value="New" <?php echo ($status == 'New') ? 'selected' : ''; ?> default>New</option>
                <option value="Closed" <?php echo ($status == 'Closed') ? 'selected' : ''; ?>>Closed</option>
                <option value="Inprogress" <?php echo ($status == 'Inprogress') ? 'selected' : ''; ?>>Inprogress</option>
                <!-- <option value="Open" <?php echo ($status == 'Open') ? 'selected' : ''; ?>>Open</option> -->
            </select>
        </div>

        <!-- Priority Field -->
        <div class="col-lg-3" style="<?php echo ($status == 'Inprogress') ? '' : 'display:none;'; ?>" id="priority-container">
            <label for="priority-field" class="form-label">Priority: <span style="color: red;">*</span></label>
            <select id="priority-field" name="priority-field" class="form-select" <?php echo ($status == 'Inprogress') ? '' : 'disabled'; ?>>
                <option value="" disabled selected>Select Priority</option>
                <option value="Medium" <?php echo ($priority == 'Medium') ? 'selected' : ''; ?>>Medium</option>
                <option value="Low" <?php echo ($priority == 'Low') ? 'selected' : ''; ?>>Low</option>
                <option value="High" <?php echo ($priority == 'High') ? 'selected' : ''; ?>>High</option>
            </select>
        </div>
    </div>
    <div class="text-center mt-3">
        <button type="submit" class="btn btn-success">Update</button>
        <button type="button" class="btn btn-danger" name="cancel" onclick="window.location.href='ticketReport.php';">Cancel</button>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "../configuration/footer.php"; ?>
