<?php
// @session_start();
include "../configuration/header.php";
include "../configuration/config.php";

$sr_no = $_GET['sr_no'] ?? '';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $base_url . '/Routes/fetch_category.php?sr_no=' . $sr_no,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Cookie: PHPSESSID=23qs3lg9d5o1eg88pd95n38gns'
  ),
));

$response = curl_exec($curl);

$category = json_decode($response, true);
// print_r($category);

$sr_no = $category['data']['sr.no'] ?? '';
$category_name = $category['data']['category_name'] ?? '';
$status = $category['data']['status'] ?? '';
$image = $category['data']['image'] ?? '';
$description = $category['data']['description'] ?? '';


// curl_close($curl);
// echo $response;
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h5 class="mb-sm-0">Update Category</h5>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Update Category</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h3 class="card-title mb-0 flex-grow-1">Category Details</h3>
                            <div class="text-center">
                                <a href="categoryReport.php" class="btn btn-primary">Category Report</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="live-preview">
                                <form action="../Controller/check_updateCategory.php" method="POST" enctype="multipart/form-data">
                                    <div class="row mt-3">

                                        <input type="hidden" name="sr_no" id="sr_no" class="form-control" placeholder="category sr_no" value="<?php echo $sr_no; ?>" readonly>

                                        <div class="col-md-6">
                                            <label for="category_name" class="form-label">Category Name: <span style="color: red;">*</span></label>
                                            <input type="text" id="category_name" class="form-control" name="category_name" value="<?php echo $category_name; ?>" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="category_status" class="form-label">Status: <span style="color: red;">*</span></label>
                                            <select id="category_status" class="form-select" name="category_status" required>
                                                <option value="" disabled selected>Select a Status</option>
                                                <option value="Active" <?php echo ($status == 'Active') ? 'selected' : ''; ?>>Active</option>
                                                <option value="Inactive" <?php echo ($status == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <!-- <div class="col-md-6">
                                            <label for="photos" class="form-label">Upload Image:</label>
                                            <input type="file" id="photos" name="photos[]" class="form-control" accept="image/*" value="<?php echo $image; ?>" multiple>
                                        </div> -->
                                        <div class="col-md-6">
                                            <label for="category_description" class="form-label">Description: <span style="color: red;">*</span></label>
                                            <textarea id="category_description" class="form-control" name="category_description" rows="3" required><?php echo $description; ?></textarea>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Current Image:</label> <br>
                                            <img src="<?php echo $image; ?>" alt="Category Image" style="height: 70px; width: 70px;">
    
                                            <input type="hidden" name="current_image" value="<?php echo $image; ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="new_image">Upload New Image (Optional)</label>
                                            <input type="file" id="new_image" name="new_image" class="form-control" accept="image/*" multiple>
                                        </div>
                                    </div>

                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-success me-3">Update</button>
                                        <a href="categoryReport.php" class="btn btn-danger">Cancel</a>
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
