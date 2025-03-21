<?php
// @session_start();
include "../configuration/header.php";
include "../configuration/config.php";

$id = $_GET['id'] ?? '';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'localhost/CropManageSystem/Routes/fetch_blog.php?id=' . $id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=mnjn1e8bg06v34j7jfdq560num'
  ),
));

$response = curl_exec($curl);

$blog = json_decode($response, true);
// print_r($blog);

$id = $blog['data']['id'] ?? '';
$title = $blog['data']['title'] ?? '';
$image = $blog['data']['image'] ?? '';
$description = $blog['data']['description'] ?? '';
$publish_date = $blog['data']['publish_date'] ?? '';


// curl_close($curl);
// echo $response;
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h5 class="mb-sm-0">Update Blog</h5>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Update Blog</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h3 class="card-title mb-0 flex-grow-1">Blog Details</h3>
                            <div class="text-center">
                                <a href="blogsReport.php" class="btn btn-primary">Blogs Report</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="live-preview">
                                <form action="../Controller/check_updateBlog.php" method="POST" enctype="multipart/form-data">
                                    <div class="row mt-3">
                                        <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $id; ?>" readonly>
                                        
                                        <div class="col-md-5">
                                            <label for="title">Title: <span style="color: red;">*</span></label>
                                            <input type="text" id="title" name="title" class="form-control" value="<?php echo $title; ?>" required>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <label>Current Image: </label> <br>
                                            <img src="<?php echo $image; ?>" alt="Blog Image" style="height: 70px; width: 70px;">
    
                                            <input type="hidden" name="current_image" value="<?php echo $image; ?>">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="new_image">Upload New Image: (Optional)</label>
                                            <input type="file" id="new_image" name="new_image" class="form-control" accept="image/*" multiple>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label for="description" class="form-label">Description:</label>
                                            <textarea id="description" class="form-control" name="description" rows="3"><?php echo $description; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-success me-3">Update</button>
                                        <a href="blogsReport.php" class="btn btn-danger">Cancel</a>
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

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> 

<?php include "../configuration/footer.php"; ?>
</body>
</html>
