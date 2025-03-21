<?php
// @session_start();
include '../configuration/header.php';
include '../configuration/config.php';

// Get the ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Check if ID is valid
if ($id <= 0) {
    echo 'Invalid ID.';
    include "footer.php";
    exit;
}

// Initialize cURL
$curl = curl_init();

// Prepare the POST data
$postData = json_encode(array('id' => $id));

curl_setopt_array($curl, array(
    CURLOPT_URL => 'localhost/CropManageSystem/Routes/getById_setting.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT =>0, // Set a reasonable timeout
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

// Debugging: Uncomment this to see the raw response and decoded data
/*
echo '<pre>';
print_r($response); // Raw response
print_r($data); // Decoded data
echo '</pre>';
*/

// Check if the data is valid
if (empty($data) || !isset($data[0])) {
    echo 'No data found for the given ID.';
    include "footer.php";
    exit;
}

// Extract the first item from the data
$settingData = $data[0];
?>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" />

<style>
  label {
      font-size: 14px;
      
      color: black;
  }
  
  .update-container {
      padding: 20px;
  }

  .update-container img {
      max-width: 200px;
      height: auto;
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
                <h5 class="mb-sm-0 custom-heading" style="margin-left:5px">Update Setting</h5>
            </div>

            <div class="update-container">
                <div class="card">
                    <div class="card-header">
                        <h5>Update Setting Details</h5>
                    </div>
                    <div class="card-body">
                        <form action="../Controller/check_updateSetting.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($settingData['id'], ENT_QUOTES, 'UTF-8'); ?>">
                            <div class="row">
                                        <!-- App Logo -->
                                        <!-- Photos -->
                                        <div class="col-md-6 mb-3 d-flex">
                                <div class="col-md-4">
                                    <label>Current Image: <span style="color: red;">*</span></label> <br>
                                    <img src="<?php echo $settingData['photos']; ?>" alt="logo Image" style="height: 70px; width: 70px;">
    
                                    <input type="hidden" name="current_image" value="<?php echo $settingData['photos']; ?>">
        </div>
                                <div class="col-md-8">
                                    <label for="new_image">Upload New Image (Optional)</label>
                                    <input type="file" id="new_image" name="new_image" class="form-control" accept="image/*" multiple>
                                </div>
        </div>
                                        

                                        <!-- App Name -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="app_name" class="form-label">App Name: <span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" id="app_name" name="app_name" placeholder="Enter app name"value="<?php echo htmlspecialchars($settingData['app_name'], ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>

                                        <!-- Contact No -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="contact_no" class="form-label">Contact No: <span style="color: red;">*</span></label>
                                                <input type="number" class="form-control" id="contact_no" name="contact_no" maxlength="10" placeholder="Enter contact number"value="<?php echo htmlspecialchars($settingData['contact_no'], ENT_QUOTES, 'UTF-8'); ?>"required>
                                            </div>
                                        </div>

                                        <!-- Email Id -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email_id" class="form-label">Email Id: <span style="color: red;">*</span></label>
                                                <input type="email" class="form-control" id="email_id" name="email_id" placeholder="Enter email address"value="<?php echo htmlspecialchars($settingData['email_id'], ENT_QUOTES, 'UTF-8'); ?>"required>
                                            </div>
                                        </div>

                                        <!-- Website -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="website" class="form-label">Website: <span style="color: red;">*</span></label>
                                                <input type="url" class="form-control" id="website" name="website" placeholder="Enter website URL"value="<?php echo htmlspecialchars($settingData['website'], ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>

                                        <!-- Copyrights -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="copyrights" class="form-label">Copyrights: <span style="color: red;">*</span></label>
                                                <input type="text" id="copyrights" name="copyrights" class="form-control" placeholder="Enter copyrights information"value="<?php echo htmlspecialchars($settingData['copyrights'], ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>

                                        <!-- Social Media Links -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="facebook_link" class="form-label">Facebook Links: <span style="color: red;">*</span></label>
                                                <input type="link" id="facebook_link" name="facebook_link" class="form-control" placeholder="Enter facebook link"value="<?php echo htmlspecialchars($settingData['facebook_link'], ENT_QUOTES, 'UTF-8'); ?>"required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="whatsapp_link" class="form-label">Whats App Links</label>
                                                <input type="link" id="whatsapp_link" name="whatsapp_link" class="form-control" placeholder="Enter whatsapp link"value="<?php echo htmlspecialchars($settingData['whatsapp_link'], ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="twitter_link" class="form-label">Twitter Links: <span style="color: red;">*</span></label>
                                                <input type="link" id="twitter_link" name="twitter_link" class="form-control" placeholder="Enter twitter link"value="<?php echo htmlspecialchars($settingData['twitter_link'], ENT_QUOTES, 'UTF-8'); ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="linkedin" class="form-label">LinkedIn Links: <span style="color: red;">*</span></label>
                                                <input type="link" id="linkedin" name="linkedin" class="form-control" placeholder="Enter linkedin link"value="<?php echo htmlspecialchars($settingData['linkedin'], ENT_QUOTES, 'UTF-8'); ?>"required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">Update Settings</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include '../configuration/footer.php';?>
