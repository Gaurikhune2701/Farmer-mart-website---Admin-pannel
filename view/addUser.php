<?php
@session_start();
include '../configuration/header.php';
?>

<script src="../view/assets/js/alert_timeout.js"></script>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h5 class="mb-sm-0">User</h5>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">User</li>
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
                            <h3 class="card-title mb-0 flex-grow-1">User</h3>
                            <div class="text-center">
                                <a href="userReport.php" class="btn btn-primary">User Report</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <p class="text-muted"></p>
                            <div class="live-preview">
                                <form action="../Controller/check_addUser.php" method="POST" autocomplete="off">
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="full_name" class="form-label">Full Name: <span style="color: red;">*</span></label>
                                            <input type="text" id="full_name" class="form-control" name="full_name" placeholder="Enter your full name." required>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="designation" class="form-label">Designation: <span style="color: red;">*</span></label>
                                            <input type="text" id="designation" class="form-control" name="designation" placeholder="Enter your designation." required>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="mobileNo" class="form-label">Mobile No: <span style="color: red;">*</span></label>
                                            <input type="tel" id="mobileNo" class="form-control" name="mobileNo" placeholder="Enter your mobile number." pattern="[0-9]{10}" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="email" class="form-label">Email: <span style="color: red;">*</span></label>
                                            <input type="email" id="email" class="form-control" name="email" placeholder="name@example.com" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="password" class="form-label">Password: <span style="color: red;">*</span></label>
                                            <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password." required>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success me-3" name="submit">Save</button>
                                        <button type="button" class="btn btn-danger" name="cancel" onclick="window.location.href='addUser.php';">Cancel</button>
                                    </div>
                                        </div>
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
