<?php
// @session_start();
include '../Configuration/config.php';

if (isset($_SESSION['UNAME'])) {
    $email = $_SESSION['UNAME'];
} else {
    $email = '';
}

$user_email = $_SESSION['UNAME'] ?? '';
$user_data = '';

if ($user_email) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $base_url . '/Routes/fetchPassword_by_email.php?email=' . urlencode($user_email),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Cookie: PHPSESSID=q96nf2p41gsmm3kc8ql1orv1l9'
        ),
    ));

   
    $response = curl_exec($curl);

    $user_data = json_decode($response, true);
    // print_r($user_data);

    // echo $user_data['id'];
    if (isset($user_data['id'])) {
        $mobileNo = htmlspecialchars($user_data['mobileNo']);
        $password = htmlspecialchars($user_data['password']);
    } else {
        echo "email not found.";
        exit;
    }
} else {
    echo "Invalid email.";
    exit;
}

// $phone = isset($_GET['mobileNo']) ? $_GET['mobileNo'] : null;
// if (empty($phone)) {
//     die('Invalid user.');
// }

// $ch = curl_init($base_url . '/Routes/getById_password.php');

// $data = json_encode(['mobileNo' => $phone]);

// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
// curl_setopt($ch, CURLOPT_HTTPHEADER, [
//     'Content-Type: application/json',
//     'Content-Length: ' . strlen($data)
// ]);

// $response = curl_exec($ch);

// if ($response === FALSE) {
//     die("cURL Error: " . curl_error($ch));
// }

// curl_close($ch);

// $json_response = json_decode($response, true);

// if ($json_response === NULL) {
//     die("Error decoding JSON response.");
// }

// if (isset($json_response[0])) {
//     $user = $json_response[0];
//     $phone = $user['mobileNo'] ?? '';
//     $password = $user['password'] ?? '';
// } else {
//     die('Invalid response from server.');
// }
?>
              
<?php
include '../Configuration/header.php';
?>

<script src="../view/assets/js/alert_timeout.js"></script>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h5 class="mb-sm-0">Update Password</h5>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Update Password</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (isset($_SESSION['success_status']) || isset($_SESSION['error_status'])): ?>
                <div id="alert-message" 
                    class="alert alert-dismissible fade show 
                    <?= isset($_SESSION['success_status']) ? 'alert-success' : 'alert-danger'; ?>" 
                    role="alert">
                    <?php if (isset($_SESSION['success_status'])): ?>
                    <?= $_SESSION['success_status'] ?>
                    <?php elseif (isset($_SESSION['error_status'])): ?>
                    <?= $_SESSION['error_status'] ?>
                    <?php endif; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['success_status']); ?>
                <?php unset($_SESSION['error_status']); ?>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Update Password</h5>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card-body">
                                <form action="../Controller/check_update_password.php" method="POST" class="form-steps was-validated">
                                    <input type="hidden" name="mobileNo" id="mobileNo" value="<?php echo $mobileNo; ?>">
                                    <input type="hidden" name="email" id="email" value="<?php echo $email; ?>">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="form-label" for="password">Password<span style="color:red">*</span></label><br>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                        
                                            <input type="hidden" class="form-control" id="current_password" name="current_password" value="<?php echo $password; ?>" required>
                                        </div>

                                        <div class="col-lg-3">
                                            <label class="form-label" for="newPassword">New password<span style="color:red">*</span></label><br>
                                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                                        </div>

                                        <div class="col-lg-3">
                                            <label class="form-label" for="confirmPassword">Confirm Password<span style="color:red">*</span></label><br>
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                        </div>
                                    </div>

                                    <div class="d-flex mt-5">
                                        <button type="submit" name="update_password" class="btn btn-success right ms-auto">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <?php
    include '../Configuration/footer.php';
    ?>
</body>
</html>
