<?php
// @session_start();
include '../configuration/header.php';
include '../configuration/config.php';

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost/CropManageSystem/Routes/fetch_allCategory.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Cookie: PHPSESSID=aqkj0j7l35av4860ev80089n5t'
    ),
));

$response = curl_exec($curl);
if ($response === false) {
    die('Curl error: ' . curl_error($curl));
}
curl_close($curl);

// Decode JSON response
$data = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die('JSON Decode Error: ' . json_last_error_msg());
}

// Check if data is an array and contains expected structure
if (!is_array($data) || empty($data)) {
    die('No categories found or invalid data structure');
}
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Start page title -->
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h5 class="mb-sm-0">Crop Management</h5>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Crop Management</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End page title -->

            <?php if (isset($_SESSION['success_status'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Hey!</strong> <?= htmlspecialchars($_SESSION['success_status']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['success_status']); ?>
            <?php elseif (isset($_SESSION['error_status'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Hey!</strong> <?= htmlspecialchars($_SESSION['error_status']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['error_status']); ?>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h3 class="card-title mb-0 flex-grow-1">Crop Management</h3>
                            <div class="text-center">
                                <a href="CropManagement_Report.php" class="btn btn-primary">Crop Report</a>
                            </div>
                        </div>
                        <!-- End card header -->

                        <div class="card-body">
                            <div class="live-preview">
                                <form action="../Controller/save_addCropManagement.php" class="form-steps was-validated" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <!-- Crop Name -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="crop_name" class="form-label">Crop Name: <span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" placeholder="Enter Crop Name" id="crop_name" name="crop_name" required>
                                            </div>
                                        </div>

                                        <!-- Crop Type -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="crop_type" class="form-label">Crop Type: <span style="color: red;">*</span></label>
                                                <select id="crop_type" class="form-select" name="crop_type" required>
                                                    <option value="" disabled selected>Select Crop Type</option>
                                                    <option value="food crop">Food Crops</option>
                                                    <option value="plantation crop">Plantation Crops</option>
                                                    <option value="cashed crop">Cashed Crops</option>
                                                    <option value="horiculture crop">Horiculture Crops</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Category -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="category" class="form-label">Category: <span style="color: red;">*</span></label>
                                                <select class="form-select" id="category" name="category" required>
                                                    <option value="">-- Select category --</option>
                                                    <?php foreach ($data['data'] as $category_name): ?>
                                                        <option value="<?= htmlspecialchars($category_name) ?>"><?= htmlspecialchars($category_name) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Season -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="season" class="form-label">Season: <span style="color: red;">*</span></label>
                                                <select id="season" class="form-select" name="season" required>
                                                    <option value="" disabled selected>Select season</option>
                                                    <option value="Summer">Summer</option>
                                                    <option value="Winter">Winter</option>
                                                    <option value="Mansoon">Mansoon</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Type -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="category2" class="form-label"> Schedule Type: <span style="color: red;">*</span></label>
                                                <select id="category2" class="form-select" name="category2" required>
                                                    <option value="" disabled selected>Choose Type</option>
                                                    <option value="weekly">Weekly</option>
                                                    <option value="daily">Daily</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Duration -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="duration" class="form-label">Duration: <span style="color: red;">*</span></label>
                                                <select id="duration" class="form-select" name="duration" required>
                                                    <option value="" disabled selected>Choose.</option>
                                                    <option value="monthly">Monthly</option>
                                                    <option value="weekly">Weekly</option>
                                                    <option value="daily">Daily</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Introduction -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="intro" class="form-label">Introduction: <span style="color: red;">*</span></label>
                                                <textarea class="form-control" placeholder="Enter..." id="intro" name="intro" rows="2" required></textarea>
                                            </div>
                                        </div>

                                        <!-- Climate -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="climate" class="form-label">Climate: <span style="color: red;">*</span></label>
                                                <textarea class="form-control" placeholder="Enter climate" id="climate" name="climate" rows="2" required></textarea>
                                            </div>
                                        </div>

                                        <!-- Soil -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="soil" class="form-label">Soil: <span style="color: red;">*</span></label>
                                                <textarea class="form-control" placeholder="Enter soil type" id="soil" name="soil" rows="2" required></textarea>
                                            </div>
                                        </div>

                                        <!-- Varieties Recommended -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="varieties_recommended" class="form-label">Varieties Recommended: <span style="color: red;">*</span></label>
                                                <textarea class="form-control" placeholder="Enter varieties recommended" id="varieties_recommended" name="varieties_recommended" rows="2" required></textarea>
                                            </div>
                                        </div>

                                        <!-- Land Preparation & Manuring -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="land" class="form-label">Land Preparation & Manuring: <span style="color: red;">*</span></label>
                                                <textarea class="form-control" placeholder="Enter land type" id="land" name="land" rows="2" required></textarea>
                                            </div>
                                        </div>

                                        <!-- Fertilizer -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="fertilizer" class="form-label">Fertilizer: <span style="color: red;">*</span></label>
                                                <textarea class="form-control" placeholder="Enter fertilizer type" id="fertilizer" name="fertilizer" rows="2" required></textarea>
                                            </div>
                                        </div>

                                        <!-- Irrigation -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="irrigation" class="form-label">Irrigation: <span style="color: red;">*</span></label>
                                                <textarea class="form-control" placeholder="Enter irrigation type" id="irrigation" name="irrigation" rows="2" required></textarea>
                                            </div>
                                        </div>

                                        <!-- Weed Control -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="weed_control" class="form-label">Weed Control: <span style="color: red;">*</span></label>
                                                <textarea class="form-control" placeholder="Enter weed control" id="weed_control" name="weed_control" rows="2" required></textarea>
                                            </div>
                                        </div>

                                        <!-- Harvesting -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="harvesting" class="form-label">Harvesting: <span style="color: red;">*</span></label>
                                                <textarea class="form-control" placeholder="Enter harvesting" id="harvesting" name="harvesting" rows="2" required></textarea>
                                            </div>
                                        </div>

                                        <!-- Post Harvest -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="post_harvest" class="form-label">Post Harvest: <span style="color: red;">*</span></label>
                                                <textarea class="form-control" placeholder="Enter post harvest" id="post_harvest" name="post_harvest" rows="2" required></textarea>
                                            </div>
                                        </div>

                                        <!-- Crop Description -->
                                        <!-- <div class="col-md-8">
                                            <div class="mb-3">
                                                <label for="crop_description" class="form-label">Crop Description</label>
                                                <textarea class="form-control" placeholder="Enter Crop Description" id="crop_description" name="crop_description" rows="2" required></textarea>
                                            </div>
                                        </div> -->

                                        <!-- Video URLs -->
                                        <div class="col-md-4">
                                            <div class="mb-4">
                                                <label for="videoLinks" class="form-label">Video URLs:<span style="color: red;">*</span></label>
                                                <input type="url" id="videoLinks" name="videoLinks[]" class="form-control" placeholder="Enter video URL" multiple>
                                            </div>
                                        </div>

                                        <!-- Status -->
                                        <!-- <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="statuss" class="form-label">Status</label>
                                                <select id="statuss" class="form-select" name="statuss" required>
                                                    <option value="" disabled selected>Choose.</option>
                                                    <option value="active" selected>Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div> -->

                                        <!-- Photos -->
    <!-- <div class="col-md-4 d-flex"> -->
    <div class="col-md-4 mb-3" id="photo-upload-container">
        <label for="photos" class="form-label">Photos:<span style="color: red;">*</span></label>
        <input type="file" id="photos" name="photos[]" class="form-control" accept="image/*" multiple>
    </div>
    <!-- <button type="button" id="add-more" class="btn btn-primary col-md-2" style="
  width: 94px;
    height: 35px;
    margin-left: 20px;
    margin-top: 27px;
">Add More</button> -->
<!-- </div> -->


                                        <!-- Submit and Cancel Buttons -->
                                        <div class="col-lg-12">
                                            <div class="text-end">
                                                <button type="submit" name="submit" class="btn btn-success">Save</button>
                                                <!-- <button type="button" class="btn btn-success" onclick="window.location.href='CropManagement.php';">Save And Add New</button> -->
                                                <button type="button" class="btn btn-danger" onclick="window.location.href='cancel_page.php';">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End row -->
                                </form>
                            </div>
                            <!-- End live preview -->
                        </div>
                        <!-- End card body -->
                    </div>
                    <!-- End card -->
                </div>
                <!-- End col -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container-fluid -->
    </div>
    <!-- End page-content -->
</div>
<!-- End main-content -->
<!-- 
<script>
document.addEventListener('DOMContentLoaded', function() {
    const durationSelect = document.getElementById('duration');
    const monthlySection = document.getElementById('monthlySection');
    const weeklySection = document.getElementById('weeklySection');
    const dailySection = document.getElementById('dailySection');

    durationSelect.addEventListener('change', function() {
        // Hide all sections first
        if (monthlySection) monthlySection.style.display = 'none';
        if (weeklySection) weeklySection.style.display = 'none';
        if (dailySection) dailySection.style.display = 'none';
        
        // Show the relevant section based on selected value
        switch (this.value) {
            case 'monthly':
                if (monthlySection) monthlySection.style.display = 'block';
                break;
            case 'weekly':
                if (weeklySection) weeklySection.style.display = 'block';
                break;
            case 'daily':
                if (dailySection) dailySection.style.display = 'block';
                break;
        }
    });
});
</script> -->
<script>
// JavaScript function to append new file input fields
document.getElementById('add-more').addEventListener('click', function() {
    // Create a new div element for the new input field
    var newDiv = document.createElement('div');
    newDiv.classList.add('mb-3');

    // Create the new input field
    var newInput = document.createElement('input');
    newInput.type = 'file';
    newInput.name = 'photos[]';
    newInput.classList.add('form-control');
    newInput.accept = 'image/*';
    newInput.multiple = true; // Optional: allow multiple files in each new field

    // Append the new input to the container
    newDiv.appendChild(newInput);
    document.getElementById('photo-upload-container').appendChild(newDiv);
});
</script>
<?php include '../configuration/footer.php'; ?>
