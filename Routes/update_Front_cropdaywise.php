<?php

session_start();
// include '../configuration/header.php';
include '../configuration/config.php';

// Ensure the uploads directory exists
$uploadDirectory = '../uploads/daywise/';
if (!is_dir($uploadDirectory)) {
    mkdir($uploadDirectory, 0755, true);
}

// Fetch existing terms and conditions
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
 $query = "SELECT * FROM cropdaywise WHERE id = $id";
$result = mysqli_query($conn, $query);
$terms = '';
if ($result && mysqli_num_rows($result) > 0) {
    $record = mysqli_fetch_assoc($result);
} else {
    exit; // Exit if no valid record is found
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
    $day_no = mysqli_real_escape_string($conn, $_POST['day_no']);
    $vanaspati_stage = mysqli_real_escape_string($conn, $_POST['vanaspati_stage']);
    $work = mysqli_real_escape_string($conn, $_POST['work']);
    $spray_drenching = mysqli_real_escape_string($conn, $_POST['spray_drenching']);
    $worker_count = mysqli_real_escape_string($conn, $_POST['worker_count']);
    $day_description = mysqli_real_escape_string($conn, $_POST['day_description']);
    $notes = mysqli_real_escape_string($conn, $_POST['notes']);

    // Handle file uploads (photos)
    // $photos = $_FILES['photos'];
    // $photoPaths = [];

    // if (isset($photos['name']) && !empty($photos['name'][0])) {
    //     foreach ($photos['tmp_name'] as $key => $tmp_name) {
    //         $photoName = basename($photos['name'][$key]);
    //         $photoPath = $uploadDirectory . $photoName;

    //         if (move_uploaded_file($tmp_name, $photoPath)) {
    //             $photoPaths[] = $photoPath;
    //         } else {
    //             echo "Failed to upload: " . htmlspecialchars($photoName);
    //         }
    //     }
    // }

    // $photoPathsStr = implode(',', $photoPaths);

    if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] == 0) {
        $image_name = $_FILES['new_image']['name'];
        $image_tmp_name = $_FILES['new_image']['tmp_name'];
        $image_folder = '../uploads/daywise/' . $image_name;
        
        move_uploaded_file($image_tmp_name, $image_folder);

        $image = $image_folder;
    } else {
        $image = $current_image;
    }

    // Convert video URLs to a comma-separated string
    $video_urls = $_POST['video_urls'];
    $videoUrlsStr = implode(',', $video_urls);

    // Update query
  echo  $updateQuery = "UPDATE cropdaywise SET 
                        duration = '$duration',
                        day_no = '$day_no',
                        vanaspati_stage = '$vanaspati_stage',
                        work = '$work',
                        spray_drenching = '$spray_drenching',
                        worker_count = '$worker_count',
                        photos = '$image',
                        video_urls = '$videoUrlsStr',
                        day_description = '$day_description',
                        notes = '$notes'
                    WHERE id = $id";

    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['success_status'] = 'Crop Daywise data has been updated successfully!';
        header('Location: ../view/CropDaywise_report.php');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

?>
<?php include '../configuration/header.php';?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Start page title -->
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
            <!-- End page title -->

            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h3 class="card-title mb-0 flex-grow-1">Daywise Description</h3>
                        </div><!-- End card header -->

                        <div class="card-body">
                            <div class="live-preview">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <!-- Duration -->
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="duration" class="form-label">Duration</label>
                                                <select id="duration" class="form-select" name="duration" required>
                                                    <option value="" disabled>Select...</option>
                                                    <option value="monthly" <?php echo $record['duration'] === 'monthly' ? 'selected' : ''; ?>>Monthly</option>
                                                    <option value="weekly" <?php echo $record['duration'] === 'weekly' ? 'selected' : ''; ?>>Weekly</option>
                                                    <option value="daily" <?php echo $record['duration'] === 'daily' ? 'selected' : ''; ?>>Daily</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Day number -->
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="day_no" class="form-label">Day No:</label>
                                                <input type="number" id="day_no" name="day_no" class="form-control" placeholder="Enter Day No" value="<?php echo htmlspecialchars($record['day_no'], ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>
                                        <!-- Plant stage -->
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="vanaspati_stage" class="form-label">Plant Stage</label>
                                                <input type="text" id="vanaspati_stage" class="form-control" placeholder="Enter Plant Stage" name="vanaspati_stage" value="<?php echo htmlspecialchars($record['vanaspati_stage'], ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>
                                        <!-- Work -->
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="work" class="form-label">Work</label>
                                                <input type="text" id="work" class="form-control" placeholder="Enter Your Work" name="work" value="<?php echo htmlspecialchars($record['work'], ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>
                                        <!-- Spray/Drenching -->
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="spray_drenching" class="form-label">Drenching</label>
                                                <input type="text" id="spray_drenching" class="form-control" placeholder="Enter Drenching" name="spray_drenching" value="<?php echo htmlspecialchars($record['spray_drenching'], ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>
                                        <!-- Worker count -->
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="worker_count" class="form-label">Labour Count</label>
                                                <input type="number" id="worker_count" class="form-control" placeholder="Enter Labour Count" name="worker_count" value="<?php echo htmlspecialchars($record['worker_count'], ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>
                                        <!-- Photos -->
                                        <div class="col-md-6 d-flex">
                                              
                                            <div class="col-md-6 me-3">
                                                <label for="new_image">Upload New Image (Optional)</label>
                                                <input type="file" id="new_image" name="new_image" class="form-control" accept="image/*" multiple>
                                            </div>
                                            <div class="col-md-5 me-3">
                                                <label for="video_urls" class="form-label">Video URLs:</label>
                                                <input type="url" id="video_urls" name="video_urls[]" class="form-control" placeholder="Enter video URL" value="<?php echo htmlspecialchars(implode(',', explode(',', $record['video_urls'])), ENT_QUOTES, 'UTF-8'); ?>" multiple>
                                            </div>
                                        </div>
                                        
                                        <!-- Day description -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="day_description" class="form-label">Day Description:</label>
                                                <textarea id="day_description" name="day_description" class="form-control" rows="3" placeholder="Enter Day Description" required><?php echo htmlspecialchars($record['day_description'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                            </div>
                                        </div>
                                        <!-- Notes -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="notes" class="form-label">Notes:</label>
                                                <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="Enter Notes"><?php echo htmlspecialchars($record['notes'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div><!-- End card body -->
                    </div><!-- End card -->
                </div><!-- End col -->
            </div><!-- End row -->
        </div><!-- End container-fluid -->
    </div><!-- End page content -->
</div><!-- End main content -->

<?php include '../configuration/footer.php'; ?>
