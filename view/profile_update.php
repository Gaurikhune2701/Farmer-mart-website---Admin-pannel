<?php
include('../configuration/config.php');

// echo $_SESSION['UNAME'];
if (isset($_SESSION['UNAME'])) {
    $email = $_SESSION['UNAME'];
} else {
    $email = '';
}
?>
<?php
include('../configuration/header.php');
?>

<script src="../view/assets/js/alert_timeout.js"></script>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h5 class="mb-sm-0">Update Profile</h5>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active">Update Profile</li>
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

                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Update Profile</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <form action="../Controller/check_update_profile.php" method="POST" class="form-steps was-validated">
                                    <input type="hidden" name="email" id="email" value="<?php echo $email; ?>">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="form-label" for="full_name">Name: <span style="color:red">*</span></label><br>
                                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                                        </div>

                                        <div class="col-lg-3">
                                            <label class="form-label" for="email">Email: <span style="color:red">*</span></label><br>
                                            <input type="email" class="form-control" id="email" name="email" required value="<?php echo $email; ?>">
                                        </div>

                                        <div class="col-lg-3">
                                            <label class="form-label" for="designation">Designation: <span style="color:red">*</span></label><br>
                                            <input type="text" class="form-control" id="designation" name="designation" required>
                                        </div>

                                        <div class="col-lg-3">
                                            <label class="form-label" for="mobileNo">Mobile No: <span style="color:red">*</span></label><br>
                                            <input type="text" class="form-control" id="mobileNo" name="mobileNo" pattern="[0-9]{10}" required>
                                        </div>

                                        <!-- <div class="col-md-6 mt-3 mb-3">
                                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
                                        </div> -->
                                    </div>
                                    <div class="d-flex mt-5">
                                        <button type="submit" name="submit" class="btn btn-success right ms-auto">Update</button>
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
</body>
</html>