<?php
// @session_start();
include "../configuration/header.php";
include "../configuration/config.php";

$id = $_GET['id'] ?? '';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $base_url . '/Routes/list_Company_Contact_Details.php',
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

$contacts = json_decode($response, true);
// print_r($contacts);

$Phone = $contacts['data'][0]['phone'] ?? '';
$Email = $contacts['data'][0]['email_id'] ?? '';
$Address = $contacts['data'][0]['address'] ?? '';
$Copyright = $contacts['data'][0]['copyrights'] ?? '';
$Content = $contacts['data'][0]['contents'] ?? '';
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h5 class="mb-sm-0">Update Contact Details</h5>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Update Contact Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h3 class="card-title mb-0 flex-grow-1">Contact Details</h3>
                            <div class="text-center">
                                <a href="contactDetailsReport.php" class="btn btn-primary">Contact Details Report</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="live-preview">
                                <form action="../Controller/check_updateContactDetails.php" method="POST">
                                    <div class="row mt-3">
                                        <input type="hidden" name="id" id="id" class="form-control" placeholder="contact details id" value="<?php echo $id; ?>" readonly>

                                        <div class="col-md-4">
                                            <label for="phone" class="form-label">Phone: <span style="color: red;">*</span></label>
                                            <input type="text" id="phone" class="form-control" name="phone" value="<?php echo $Phone; ?>" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="email_id" class="form-label">Email: <span style="color: red;">*</span></label>
                                            <input type="email" id="email_id" class="form-control" name="email_id" value="<?php echo $Email; ?>" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="copyrights" class="form-label">Copyrights: <span style="color: red;">*</span></label>
                                            <input type="text" id="copyrights" class="form-control" name="copyrights" value="<?php echo $Copyright; ?>" required>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label for="address" class="form-label">Address: <span style="color: red;">*</span></label>
                                            <textarea id="address" class="form-control" name="address" rows="3" required><?php echo $Address; ?></textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="contents" class="form-label">Content: <span style="color: red;">*</span></label>
                                            <textarea id="contents" class="form-control" name="contents" rows="3" required><?php echo $Content; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-success me-3">Update</button>
                                        <a href="contactDetailsReport.php" class="btn btn-danger">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> 

<?php include "../configuration/footer.php"; ?>
</body>
</html>
