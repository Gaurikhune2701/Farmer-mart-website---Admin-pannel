<?php
// session_start();

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $full_name = trim($_POST['full_name']);
    $designation = trim($_POST['designation']);
    $email = trim($_POST['email']);
    $mobileNo = trim($_POST['mobileNo']);

    // Validate required fields
    if (empty($full_name) || empty($designation) || empty($email) || empty($mobileNo)) {
        $_SESSION['error_status'] = "All fields are required.";
        header("Location: ../view/profile_update.php");
        exit();
    }

    // Prepare data array for the JSON request
    $data = array(
        "email" => $email,
        "full_name" => $full_name,
        "designation" => $designation,
        "mobileNo" => $mobileNo,
        
    );

    // Encode data to JSON format
   echo   $json_data = json_encode($data);

    // Initialize cURL session
    $curl = curl_init();

    // Set cURL options
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost/CropManageSystem/Routes/updateProfile.php', // Update this URL to your API's correct endpoint
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $json_data, // JSON data from the form
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: PHPSESSID=' . session_id() // Pass current session ID
        ),
    ));

    // Execute cURL request and capture the response
    $response = curl_exec($curl);
    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE); // Get HTTP status code
    $curl_error = curl_error($curl);
    curl_close($curl);

    // Check if there was an error in the cURL request
    if ($curl_error) {
        $_SESSION['error_status'] = "Error occurred during request: " . $curl_error;
        header("Location: ../view/profile_update.php");
        exit();
    }else {
        echo $response;
        $_SESSION['success_status'] = 'Profile has been updated successfully.';
        echo "<script>
            window.location.href = '../view/index.php';
        </script>";
    }

    curl_close($curl);
} else {
    // If form is not submitted, set an error message
    $_SESSION['error_status'] = "Form submission failed. Please try again.";
    header("Location: ../view/profile_update.php");
    exit();
}
?>
