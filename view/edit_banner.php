<?php
// @session_start();
include "../configuration/header.php";
include "../configuration/config.php";

$sr_no = $_GET['sr_no'] ?? '';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $base_url . '/Routes/fetch_banner.php?sr_no=' . $sr_no,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Cookie: PHPSESSID=68pi8kleqj4q94cdaqj45v4300'  
  ),
));

$response = curl_exec($curl);

$banner = json_decode($response, true);
// print_r($banner);

$sr_no = $banner['data']['sr_no'] ?? '';
$image = $banner['data']['image'] ?? '';
$description = $banner['data']['description'] ?? '';


// curl_close($curl);
// echo $response;
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h5 class="mb-sm-0">Update Banner</h5>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Update Banner</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h3 class="card-title mb-0 flex-grow-1">Banner Details</h3>
                            <div class="text-center">
                                <a href="bannerReport.php" class="btn btn-primary">Banner Report</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="live-preview">
                                <form action="../Controller/check_updateBanner.php" method="POST" enctype="multipart/form-data">
                                    <div class="row mt-3">
                                        <input type="hidden" name="sr_no" id="sr_no" class="form-control" value="<?php echo $sr_no; ?>" readonly>

                                        <!-- <div class="col-md-6">
                                            <label for="photos" class="form-label">Upload Image:</label>
                                            <input type="file" id="photos" name="photos[]" class="form-control" accept="image/*" value="<?php echo $image; ?>" multiple>
                                        </div> -->
                                        <div class="col-md-6">
                                            <label for="description" class="form-label">Description:</label>
                                            <textarea id="description" class="form-control" name="description" rows="3"><?php echo $description; ?></textarea>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Current Image:</label> <br>
                                            <img src="<?php echo $image; ?>" alt="Banner Image" style="height: 70px; width: 70px;">
    
                                            <input type="hidden" name="current_image" value="<?php echo $image; ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="new_image">Upload New Image (Optional)</label>
                                            <input type="file" id="new_image" name="new_image" class="form-control" accept="image/*" multiple>
                                        </div>
                                    </div>

                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-success me-3">Update</button>
                                        <a href="bannerReport.php" class="btn btn-danger">Cancel</a>
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
