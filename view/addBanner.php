<?php
// @session_start();
include "../configuration/header.php"; 
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h5 class="mb-sm-0">Banner</h5>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Banner</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h3 class="card-title mb-0 flex-grow-1">Banner</h3>
                            <div class="text-center">
                                <a href="bannerReport.php" class="btn btn-primary">Banner Report</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <p class="text-muted"></p>
                                <div class="live-preview">
                                    <form action="../Controller/check_addBanner.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <input type="hidden" name="sr_no" id="sr_no" class="form-control" placeholder="category sr_no" value="<?php echo $sr_no; ?>" readonly>

                                            <div class="col-md-6 form-group">
                                                <!-- Multiple Photo Upload -->
                                                <label for="photos" class="form-label">Banner Image: <span style="color: red;">*</span></label>
                                                <input type="file" id="photos" name="photos[]" accept="image/*" multiple class="form-control" required>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="description" class="form-label">Description:</label>
                                                <textarea name="description" id="description" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-success me-3">Save</button>
                                            <a href="addBanner.php" class="btn btn-danger">cancel</a>                                        
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