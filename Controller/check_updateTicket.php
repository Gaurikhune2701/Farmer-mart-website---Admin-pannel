<?php
session_start();

include '../configuration/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = array(
        'ticket_id' => $_POST['ticket_id'] ?? '',
        'title' => $_POST['title_name'] ?? '',
        'customer_name' => $_POST['customer_name'] ?? '',
        'description' => $_POST['description'] ?? '',
        'assign_to' => $_POST['assignedto'] ?? '',
        'created_at' => $_POST['created_date'] ?? '',
        'due_date' => $_POST['duedate'] ?? '',
        'status' => $_POST['ticket-status'] ?? '',
        'priority' => $_POST['priority-field'] ?? ''
    );

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $base_url . '/Routes/update_ticket.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($data),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Cookie: PHPSESSID=23qs3lg9d5o1eg88pd95n38gns'
  ),
));

$response = curl_exec($curl);


    if (curl_errno($curl)) {
        echo 'Error:' . curl_error($curl);
    } else {
        echo $response;
        $_SESSION['success_status'] = 'Ticket has been updated successfully.';
        echo "<script>
                window.location.href = '../View/ticketReport.php';
            </script>";
    }

    curl_close($curl);
} else {
    echo 'Invalid request method. Please submit the form properly.';
}
?>
