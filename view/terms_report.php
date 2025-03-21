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
                <h5 class="mb-sm-0 custom-heading">Terms And Conditions</h5>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">Terms And Conditions</li>
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
                        <h6>Terms And Conditions</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
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
    // Fetch terms and conditions from the API
  
    // Fetch terms and conditions from the API
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $base_url . '/Routes/getAll_terms.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
            'Cookie: PHPSESSID=9ef2126fs57j2h7ncpj4dle9cr'
        ),
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    
    $data = json_decode($response, true);
    
    if (!empty($data)) {
        $srNo = 1;
        foreach ($data as $row) {
            $termsText = htmlspecialchars_decode(htmlspecialchars($row['terms']));
            $string = strip_tags($termsText);
            if (strlen($string) > 100) {
                $stringCut = substr($string, 0, 100);
                $endPoint = strrpos($stringCut, ' ');
                $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                $displayText = $string . '... ';
                $remainingText = substr($termsText, strlen($string));
            } else {
                $displayText = $termsText;
                $remainingText = '';
            }
    
            echo "<tr>
                    <td>{$srNo}</td>
                    <td>
                        <span class='display-text'>{$displayText}</span>
                        <span class='full-text' style='display:none;'>" . nl2br($remainingText) . "</span>
                        <span class='read-more-btn' id='read-more-btn-{$srNo}'>Read More</span>
                    </td>
                    <td>
                        <a href='view_terms.php?id=" . $row['id'] . "' class='btn btn-success'>View</a>
                        <a href='update_front_terms.php?id=" . $row['id'] . "' class='btn btn-warning'>Update</a>
                    </td>
                  </tr>";
    
            $srNo++;
        }
    } else {
        echo "<tr><td colspan='3'>No records found</td></tr>";
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

<script src="assets/js/pages/datatables.init.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const readMoreButtons = document.querySelectorAll('.read-more-btn');

        readMoreButtons.forEach(button => {
            button.addEventListener('click', function() {
                const fullTextElement = this.previousElementSibling; // Get the hidden full text element
                const displayTextElement = this.previousElementSibling.previousElementSibling; // Get the display text element
                
                // Append the remaining text to the display text
                displayTextElement.innerHTML += '<br>' + fullTextElement.innerHTML;
                
                // Hide the "Read More" button
                this.style.display = 'none';
            });
        });
    });
</script>

<?php include "../configuration/footer.php"; ?>
