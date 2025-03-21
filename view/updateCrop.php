<?php
// @session_start();
include '../configuration/header.php';
include '../configuration/config.php';



// Get the ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// // Check if ID is valid
// if ($id <= 0) {
//     echo 'Invalid ID.';
//     include "footer.php";
//     exit;
// }

// Initialize cURL
$curl = curl_init();

// Prepare the POST data
$postData = json_encode(array('id' => $id));

curl_setopt_array($curl, array(
    CURLOPT_URL => 'localhost/CropManageSystem/Routes/GetById_Crop.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Cookie: PHPSESSID=189gp2huadkvh5qcqt8v1srnum'
      ),
    ));
// Execute cURL request and fetch the response
$response = curl_exec($curl);

if ($response === false) {
    echo 'cURL Error: ' . curl_error($curl);
    curl_close($curl);
    include "footer.php";
    exit;
}

curl_close($curl);

// Decode the JSON response
$data = json_decode($response, true);
// print_r($data);

// Check if the data is valid
if (empty($data) || !isset($data[0])) {
    echo 'No data found for the given ID.';
    include "footer.php";
    exit;
}

// Extract the first item from the data
$cropData = $data[0];
// print_r($cropData);
?>
<?php 


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
curl_close($curl);

// Check if response is empty
if ($response === false) {
    die('Curl error: ' . curl_error($curl));
}

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
<style>
  label {
      font-size: 14px;
      color: black;
  }
  
  .update-container {
      padding: 20px;
  }

  .update-container form {
      width: 100%;
  }

  .update-container form .form-group {
      margin-bottom: 15px;
  }

  .update-container form .form-group label {
      display: block;
      margin-bottom: 5px;
  }

  .update-container form .form-group input,
  .update-container form .form-group textarea,
  .update-container form .form-group select {
      width: 100%;
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 4px;
  }
</style>

<main class="main-content">
    <div class="page-content">
        <div class="page-header">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent" style="padding:10px">
                <h5 class="mb-sm-0 custom-heading" style="margin-left:5px">Update Crop</h5>
            </div>

            <div class="update-container">
                <div class="card">
                    <div class="card-header">
                        <h5>Update Crop Details</h5>
                    </div>
                    <div class="card-body">
                    <form action="../Controller/check_updateCrop.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($cropData['id'], ENT_QUOTES, 'UTF-8'); ?>">

                            <div class="row">
                                <!-- Crop Name -->
                                <div class="col-md-4 mb-3">
                                    <label for="crop_name" class="form-label">Crop Name</label>
                                    <input type="text" class="form-control" id="crop_name" name="crop_name" placeholder="Enter crop name" value="<?php echo htmlspecialchars($cropData['crop_name'], ENT_QUOTES, 'UTF-8'); ?>" required>
                                </div>

                                <!-- Crop Type -->
                                <div class="col-md-4 mb-3">
                                    <label for="crop_type" class="form-label">Crop Type</label>
                                    <select id="crop_type" class="form-select" name="crop_type" required>
                                        <option value="" disabled>Select Crop Type</option>
                                        <option value="food crop" <?php echo $cropData['crop_type'] === 'food crop' ? 'selected' : ''; ?>>Food Crops</option>
                                        <option value="plantation crop" <?php echo $cropData['crop_type'] === 'plantation crop' ? 'selected' : ''; ?>>Plantation Crops</option>
                                        <option value="cashed crop" <?php echo $cropData['crop_type'] === 'cashed crop' ? 'selected' : ''; ?>>Cashed Crops</option>
                                        <option value="horiculture crop" <?php echo $cropData['crop_type'] === 'horiculture crop' ? 'selected' : ''; ?>>Horiculture Crops</option>
                                    </select>
                                </div>
<!-- Category -->
<div class="col-md-4 mb-3">
    <label for="category" class="form-label">Category</label>
    <select class="form-select" id="category" name="category" required>
        <option value="" disabled>-- Select category --</option>
        <?php foreach ($data['data'] as $category_name): ?>
            <option value="<?php echo htmlspecialchars($category_name, ENT_QUOTES, 'UTF-8'); ?>"
                <?php echo $cropData['category'] === $category_name ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($category_name, ENT_QUOTES, 'UTF-8'); ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

                                <!-- Season -->
                                <div class="col-md-4 mb-3">
                                    <label for="season" class="form-label">Season</label>
                                    <select id="season" class="form-select" name="season" required>
                                        <option value="" disabled>Select Season</option>
                                        <option value="season1" <?php echo $cropData['season'] === 'season1' ? 'selected' : ''; ?>>Summer</option>
                                        <option value="season2" <?php echo $cropData['season'] === 'season2' ? 'selected' : ''; ?>>Winter</option>
                                        <option value="season3" <?php echo $cropData['season'] === 'season3' ? 'selected' : ''; ?>>Mansoon</option>
                                    </select>
                                </div>

                                <!-- Climate -->
                                <div class="col-md-4 mb-3">
                                    <label for="climate" class="form-label">Climate</label>
                                    <textarea class="form-control" id="climate" name="climate" placeholder="Enter climate information" rows="2" required><?php echo htmlspecialchars($cropData['climate'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                </div>

                                <!-- Soil -->
                                <div class="col-md-4 mb-3">
                                    <label for="soil" class="form-label">Soil</label>
                                    <textarea class="form-control" id="soil" name="soil" placeholder="Enter soil information" rows="2" required><?php echo htmlspecialchars($cropData['soil'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                </div>

                                <!-- Varieties Recommended -->
                                <div class="col-md-4 mb-3">
                                    <label for="varieties_recommended" class="form-label">Varieties Recommended</label>
                                    <textarea class="form-control" id="varieties_recommended" name="varieties_recommended" placeholder="Enter recommended varieties" rows="2" required><?php echo htmlspecialchars($cropData['varieties_recommended'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                </div>

                                <!-- Land Preparation & Manuring -->
                                <div class="col-md-4 mb-3">
                                    <label for="land" class="form-label">Land Preparation & Manuring</label>
                                    <textarea class="form-control" id="land" name="land" placeholder="Enter land preparation & manuring details" rows="2" required><?php echo htmlspecialchars($cropData['land'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                </div>

                                <!-- Fertilizer -->
                                <div class="col-md-4 mb-3">
                                    <label for="fertilizer" class="form-label">Fertilizer</label>
                                    <textarea class="form-control" id="fertilizer" name="fertilizer" placeholder="Enter fertilizer details" rows="2" required><?php echo htmlspecialchars($cropData['fertilizer'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                </div>

                                <!-- Irrigation -->
                                <div class="col-md-4 mb-3">
                                    <label for="irrigation" class="form-label">Irrigation</label>
                                    <textarea class="form-control" id="irrigation" name="irrigation" placeholder="Enter irrigation details" rows="2" required><?php echo htmlspecialchars($cropData['irrigation'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                </div>

                                <!-- Weed Control -->
                                <div class="col-md-4 mb-3">
                                    <label for="weed_control" class="form-label">Weed Control</label>
                                    <textarea class="form-control" id="weed_control" name="weed_control" placeholder="Enter weed control methods" rows="2" required><?php echo htmlspecialchars($cropData['weed_control'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                </div>

                                <!-- Harvesting -->
                                <div class="col-md-4 mb-3">
                                    <label for="harvesting" class="form-label">Harvesting</label>
                                    <textarea class="form-control" id="harvesting" name="harvesting" placeholder="Enter harvesting information" rows="2" required><?php echo htmlspecialchars($cropData['harvesting'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                </div>

                                <!-- Post Harvest -->
                                <div class="col-md-4 mb-3">
                                    <label for="post_harvest" class="form-label">Post Harvest</label>
                                    <textarea class="form-control" id="post_harvest" name="post_harvest" placeholder="Enter post harvest details" rows="2" required><?php echo htmlspecialchars($cropData['post_harvest'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                </div>

                                <!-- Type -->
                                <div class="col-md-4 mb-3">
                                    <label for="category2" class="form-label">Type</label>
                                    <select id="category2" class="form-select" name="category2" required>
                                        <option value="" disabled selected>Choose Type</option>
                                        <option value="weekly" <?php echo $cropData['category2'] === 'weekly' ? 'selected' : ''; ?>>Weekly</option>
                                        <option value="daily" <?php echo $cropData['category2'] === 'daily' ? 'selected' : ''; ?>>Daily</option>
                                    </select>
                                </div>

                                <!-- Duration -->
                                <div class="col-md-4 mb-3">
                                    <label for="duration" class="form-label">Duration</label>
                                    <select id="duration" class="form-select" name="duration" required>
                                        <option value="" disabled selected>Choose Duration</option>
                                        <option value="monthly" <?php echo $cropData['duration'] === 'monthly' ? 'selected' : ''; ?>>Monthly</option>
                                        <option value="weekly" <?php echo $cropData['duration'] === 'weekly' ? 'selected' : ''; ?>>Weekly</option>
                                        <option value="daily" <?php echo $cropData['duration'] === 'daily' ? 'selected' : ''; ?>>Daily</option>
                                    </select>
                                </div>

                                <!-- Introduction -->
                                <div class="col-md-4 mb-3">
                                    <label for="intro" class="form-label">Introduction</label>
                                    <textarea class="form-control" id="intro" name="intro" placeholder="Enter introduction" rows="2" required><?php echo htmlspecialchars($cropData['intro'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                </div>

                                <!-- Video Links -->
                                <div class="col-md-4 mb-3">
                                    <label for="videolinks" class="form-label">Video URLs</label>
                                    <input type="url" id="videolinks" name="videolinks" class="form-control" placeholder="Enter video URLs" value="<?php echo htmlspecialchars($cropData['videolinks'], ENT_QUOTES, 'UTF-8'); ?>">
                                </div>

                                <!-- Photos -->
                                <!-- <div class="col-md-4 mb-3">
                                    <label for="photos" class="form-label">Image</label>
                                    <input type="file" id="photos" name="photos[]" class="form-control" accept="image/*" multiple>
                                </div> -->
                                <div class="col-md-4 mb-3 d-flex">
                                <div class="col-md-4">
                                    <label>Current Image:</label> <br>
                                    <img src="<?php echo $cropData['photos']; ?>" alt="Crop Image" style="height: 70px; width: 70px;">
    
                                    <input type="hidden" name="current_image" value="<?php echo $cropData['photos']; ?>">
        </div>
                                <div class="col-md-8">
                                    <label for="new_image">Upload New Image (Optional)</label>
                                    <input type="file" id="new_image" name="new_image" class="form-control" accept="image/*" multiple>
                                </div>
        </div>
        

                            <!-- Status -->
                                <div class="col-md-4 mb-3">
                                    <label for="statuss" class="form-label">Status</label>
                                    <select id="statuss" class="form-select" name="statuss" required>
                                        <option value="" disabled>Choose.</option>
                                        <option value="active" <?php echo $cropData['statuss'] === 'active' ? 'selected' : ''; ?>>Active</option>
                                        <option value="inactive" <?php echo $cropData['statuss'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                    </select>
                                </div>

                                <!-- Crop Description -->
                                <div class="col-md-8 mb-3">
                                    <label for="crop_description" class="form-label">Crop Description</label>
                                    <textarea class="form-control" id="crop_description" name="crop_description" rows="4" placeholder="Enter crop description"><?php echo htmlspecialchars($cropData['crop_description'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-md-12 text-end">
                                    <button type="submit"name="submit"class="btn btn-primary" onclick="window.href(../Controller/check_updateCrop.php)">Update Crop</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include '../configuration/footer.php';
?>
