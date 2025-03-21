<?php
@session_start();
include "../configuration/header.php";
include "../configuration/config.php";

$user_id = $_GET['id'] ?? '';
$user_data = '';

if ($user_id) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $base_url . '/Routes/fetch_user.php?id=' . urlencode($user_id),
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
    // curl_close($curl);

    $user_data = json_decode($response, true);

    if (isset($user_data['id'])) {
        $full_name = htmlspecialchars($user_data['full_name']);
        $designation = htmlspecialchars($user_data['designation']);
        $mobileNo = htmlspecialchars($user_data['mobileNo']);
        $email = htmlspecialchars($user_data['email']);
    } else {
        echo "User not found.";
        exit;
    }
} else {
    echo "Invalid User ID.";
    exit;
}
?>

<script src="../view/assets/js/alert_timeout.js"></script>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h5 class="mb-sm-0">Update User</h5>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Update User</li>
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
                        <div class="card-header align-items-center d-flex">
                            <h3 class="card-title mb-0 flex-grow-1">User Details</h3>
                            <div class="text-center">
                                <a href="userReport.php" class="btn btn-primary">User Report</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="../Controller/check_updateUser.php" method="POST" autocomplete="off">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user_id); ?>">

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="full_name" class="form-label">Full Name: <span style="color: red;">*</span></label>
                                        <input type="text" id="full_name" class="form-control" name="full_name" value="<?php echo $full_name; ?>" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="designation" class="form-label">Designation: <span style="color: red;">*</span></label>
                                        <input type="text" id="designation" class="form-control" name="designation" value="<?php echo $designation; ?>" required>
                                    </div>

                                    
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="mobileNo" class="form-label">Mobile No: <span style="color: red;">*</span></label>
                                        <input type="tel" id="mobileNo" class="form-control" name="mobileNo" value="<?php echo $mobileNo; ?>" pattern="[0-9]{10}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email: <span style="color: red;">*</span></label>
                                        <input type="email" id="email" class="form-control" name="email" value="<?php echo $email; ?>" required>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success me-3" name="submit">Update</button>
                                    <button type="button" class="btn btn-danger" name="cancel" onclick="window.location.href='userReport.php';">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../configuration/footer.php"; ?>
