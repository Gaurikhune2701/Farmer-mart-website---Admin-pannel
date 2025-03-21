<?php
// @session_start();
include "../configuration/header.php"; 
?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h5 class="mb-sm-0">Manage Categories</h5>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Manage Categories</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h3 class="card-title mb-0 flex-grow-1">Manage Categories</h3>
                            <div class="text-center">
                                <a href="categoryReport.php" class="btn btn-primary">Category Report</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="live-preview">
                                <form action="../controller/check_addCategory.php" method="POST" enctype="multipart/form-data">
                                    <div class="row mt-3">
                                        <input type="hidden" name="sr_no" id="sr_no" class="form-control" placeholder="category sr_no" value="<?php echo $sr_no; ?>" readonly>

                                        <div class="col-md-6">
                                            <label for="category_name" class="form-label">Category Name: <span style="color: red;">*</span></label>
                                            <input type="text" id="category_name" class="form-control" name="category_name" placeholder="Enter Category Name." required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="category_status" class="form-label">Status: <span style="color: red;">*</span></label>
                                            <select id="category_status" class="form-select" name="category_status" required>
                                                <option value="" disabled selected>Select a Status</option>
                                                <option value="Active" selected>Active</option>                                                
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label for="photos" class="form-label">Upload Image: <span style="color: red;">*</span></label>
                                            <input type="file" id="photos" name="photos[]" class="form-control" accept="image/*" multiple required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="category_description" class="form-label">Description: <span style="color: red;">*</span></label>
                                            <textarea id="category_description" class="form-control" name="category_description" placeholder="Enter Category Description." rows="3" required></textarea>
                                        </div>
                                    </div>

                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-success me-3">Save</button>
                                        <a href="manageCategories.php" class="btn btn-danger">cancel</a>
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
