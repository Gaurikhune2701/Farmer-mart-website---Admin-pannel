<?php
// @session_start();

// Initialize cURL
$curl = curl_init();

// Set cURL options
curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost/CropManageSystem/Routes/getAll_about.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Cookie: PHPSESSID=42kshde3ofcapa6g3v9ieeaqap'
    ),
));

// Execute cURL request and get the response
$response = curl_exec($curl);

// Check for cURL errors
if (curl_errno($curl)) {
    echo 'cURL Error: ' . curl_error($curl);
    exit;
}

// Close cURL session
curl_close($curl);

// Decode JSON response
$data = json_decode($response, true);

// Check if the response contains data
$records = is_array($data) ? $data : [];
?>

<?php include "../configuration/header.php"; ?>

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
    .read-more-btn {
        cursor: pointer;
        color: #007bff;
        text-decoration: underline;
    }
</style>
<main class="main-content">
    <div class="page-content">
        <div class="page-header">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent" style="padding:10px">
                <h5 class="mb-sm-0 custom-heading">About Us</h5>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">About Us</li>
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
                        <h5>About Us</h5>
                    </div>
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php if (!empty($records)): ?>
                                <table id="buttons-datatables" class="display table table-bordered" style="width:100%">                     
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Sr.No</th>
                                        <th scope="col">Information</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $srNo = 1;
                                    foreach ($records as $row) {
                                        $termsText = htmlspecialchars_decode(htmlspecialchars($row['about']));
                                        $string = strip_tags($termsText);
                                        if (strlen($string) > 100) {
                                            $stringCut = substr($string, 0, 100);
                                            $endPoint = strrpos($stringCut, ' ');
                                            $displayText = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                            $remainingText = substr($termsText, strlen($displayText));
                                            $displayText .= ' <span class="read-more-btn" style="cursor:pointer; color:blue;">Read More</span>';
                                        } else {
                                            $displayText = $termsText;
                                            $remainingText = '';
                                        }

                                        echo "<tr>
                                            <td>$srNo</td>
                                            <td class='long-text'>
                                                <span class='display-text'>{$displayText}</span>
                                                <span class='full-text' style='display:none;'>" . nl2br($remainingText) . "</span>
                                            </td>
                                            <td>
                                                <a href='view_about.php?id={$row['id']}' class='btn btn-success'>View</a>
                                                <a href='../Routes/update_Fabout.php?id={$row['id']}' class='btn btn-warning'>Update</a>
                                            </td> </tr>";
                                        $srNo++;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="no-data-message">No data available</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="assets/js/pages/datatables.init.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
        // $('#buttons-datatables').DataTable({
        //     lengthChange: false,
        //     searching: false,
        //     paging: false
        // });

        // "Read More" button functionality
        $(document).on('click', '.read-more-btn', function() {
            const fullTextElement = $(this).closest('td').find('.full-text');
            const displayTextElement = $(this).closest('td').find('.display-text');

            // Append the remaining text to the display text
            displayTextElement.append('<br>' + fullTextElement.html());
            $(this).hide(); // Hide the "Read More" button
        });
    });
</script>


<?php include "../configuration/footer.php"; ?>
