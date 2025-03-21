<?php
include '../configuration/header.php';
include '../configuration/config.php'; // Ensure this contains your database connection settings

// Get the crop_id from the URL
$crop_id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';

if ($crop_id) {
    // Fetch crop_name and duration from the crop_management table using crop_id
    $query = "SELECT crop_name, duration FROM crop_management WHERE id = ?";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('i', $crop_id); 
        $stmt->execute();
        $stmt->bind_result($crop_name, $duration);
        $stmt->fetch();
        $stmt->close();
    }
}
$conn->close();
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h5 class="mb-sm-0">Crop Daywise Description</h5>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Daywise Description</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h3 class="card-title mb-0 flex-grow-1">Daywise Description</h3>
                        </div>
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="../Controller/check_add_daywise.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <!-- Hidden ID field -->
                                        <input type="hidden" name="crop_id" value="<?php echo $crop_id; ?>">

                                        <!-- Crop Name field -->
                                        <div class="col-md-3">
                                            <label for="crop_name">Crop Name:</label>
                                            <input type="text" id="crop_name" name="crop_name" class="form-control" value="<?php echo $crop_name; ?>" readonly>
                                        </div>

                                        <!-- Duration field -->
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="duration" class="form-label">Duration</label>
                                                <input type="number" id="duration" class="form-control" name="duration" value= "">
                                            </div>
                                        </div>

                                        <!-- Day number -->
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="day_no" class="form-label">Day No:</label>
                                                <input type="number" id="day_no" name="day_no" class="form-control" placeholder="Enter Day No" required>
                                            </div>
                                        </div>

                                        <!-- Plant stage -->
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="vanaspati_stage" class="form-label">Plant Stage</label>
                                                <input type="text" id="vanaspati_stage" class="form-control" placeholder="Enter Plant Stage" name="vanaspati_stage" required>
                                            </div>
                                        </div>

                                        <!-- Work -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="work" class="form-label">Work</label>
                                                <input type="text" id="work" class="form-control" placeholder="Enter Your Work" name="work" required>
                                            </div>
                                        </div>

                                        <!-- Spray/Drenching -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="spray_drenching" class="form-label">Drenching</label>
                                                <input type="text" id="spray_drenching" class="form-control" placeholder="Enter Drenching" name="spray_drenching" required>
                                            </div>
                                        </div>

                                        <!-- Worker count -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="worker_count" class="form-label">Labour Count</label>
                                                <input type="number" id="worker_count" class="form-control" placeholder="Enter Labour Count" name="worker_count" required>
                                            </div>
                                        </div>
                                       
                                        <!-- Day description -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="day_description" class="form-label">Day Description:</label>
                                                <textarea id="day_description" name="day_description" class="form-control" rows="3" placeholder="Enter Day Description" required></textarea>
                                            </div>
                                        </div>

                                        <!-- Notes -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="notes" class="form-label">Notes:</label>
                                                <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="Enter Your Notes" required></textarea>
                                            </div>
                                        </div>

                                        <!-- Photos -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="photos" class="form-label">Photos:</label>
                                                <input type="file" id="photos" name="photos[]" class="form-control" accept="image/*" multiple>
                                            </div>
                                        </div>

                                        <!-- Video URLs -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="video_urls" class="form-label">Video URLs:</label>
                                                <input type="url" id="video_urls" name="video_urls[]" class="form-control" placeholder="Enter video URL" multiple>
                                            </div>
                                        </div>

                                        <!-- Submit and cancel buttons -->
                                        <div class="col-lg-12">
                                            <div class="text-end">
                                                <button type="submit" id="submit" name="submit" class="btn btn-success">Save</button>
                                                <button type="button" class="btn btn-danger" onclick="window.location.href='cancel_page.php';">Cancel</button>
                                            </div>
                                        </div>
                                    </div><!-- End row -->
                                </form>
                            </div><!-- End live preview -->
                        </div><!-- End card body -->
                    </div><!-- End card -->
                </div><!-- End col -->
            </div><!-- End row -->
        </div><!-- End container-fluid -->
    </div><!-- End page-content -->
</div><!-- End main-content -->

<?php
include '../configuration/footer.php';
?>
