<?php
@session_start();
$msg = "";
$otp = $_SESSION['otp'];
if(isset($_POST['submit']))
{
    $submit_otp = $_POST['otp'];
    if($submit_otp == $otp)
    {
        header("location:new_password.php");
    }
    else{
        $msg = "Please Enter valid OTP";
    }
}
?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>

    <meta charset="utf-8" />
    <title>Forgot password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Weapon Armory Management System" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />

</head>

<style>
    .auth-bg-cover {
        background: white !important;
    }
    
    .card-bg-fill {
        border: none;
        background-color: #fff; /* Change to preferred background color */
        box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.1); /* Add shadow for better visual effect */
    }

    .auth-page-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }
</style>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card overflow-hidden card-bg-fill text-center mx-auto p-lg-4 p-3">

                            <div class="mb-4">
                                <div class="avatar-lg mx-auto">
                                    <div class="avatar-title bg-light text-primary display-5 rounded-circle">
                                        <i class="ri-mail-line"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="text-muted text-center mx-lg-3">
                                <h4>Verify Your Email</h4>
                                <p>Please enter the 6 digit code sent to <span class="fw-semibold"></span></p>
                                <p style="color:red"><?php echo $msg;?></p>
                            </div>
                            <?php
                            if (isset($_SESSION['otp_error'])) {
                                echo '<p class="error">' . $_SESSION['otp_error'] . '</p>';
                                unset($_SESSION['otp_error']);  // Remove the error message after displaying it
                            }
                            ?>

                            <div class="mt-3">
                                <form autocomplete="off" action="otp_verify.php" method="post" enctype="multipart/form-data">
                                    <div class="row justify-content-center">
                                        <div class="col-2">
                                            <div class="mb-3">
                                                <label for="digit_1" class="visually-hidden">Digit 1</label>
                                                <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(1, event)" maxLength="1" id="digit_1" name="digit_1" required>
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-2">
                                            <div class="mb-3">
                                                <label for="digit_2" class="visually-hidden">Digit 2</label>
                                                <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(2, event)" maxLength="1" id="digit_2" name="digit_2" required>
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-2">
                                            <div class="mb-3">
                                                <label for="digit_3" class="visually-hidden">Digit 3</label>
                                                <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(3, event)" maxLength="1" id="digit_3" name="digit_3" required>
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-2">
                                            <div class="mb-3">
                                                <label for="digit_4" class="visually-hidden">Digit 4</label>
                                                <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(4, event)" maxLength="1" id="digit_4" name="digit_4" required>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="mb-3">
                                                <label for="digit_5" class="visually-hidden">Digit 5</label>
                                                <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(5, event)" maxLength="1" id="digit_5" name="digit_5" required>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="mb-3">
                                                <label for="digit_6" class="visually-hidden">Digit 6</label>
                                                <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(6, event)" maxLength="1" id="digit_6" name="digit_6" required>
                                            </div>
                                        </div><!-- end col -->
                                    </div>

                                    <div class="mt-3">
                                        <input type="hidden" required name="email" class="form-control" value="" id="email">
                                        <button type="submit" name="otp_forget" class="btn btn-primary w-100">Confirm</button>
                                    </div>
                                </form>
                            </div>

                            <div class="mt-3 text-center">
                                <p class="mb-0">Didn't receive a code? <a href="resend_session_destroy.php" class="fw-semibold text-primary text-decoration-underline">Resend</a></p>
                            </div>

                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end auth page content -->
    </div><!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- two-step-verification js -->
    <script src="assets/js/pages/two-step-verification.init.js"></script>

    
    // if (isset($_SESSION['otp_error'])) {
    //     echo "<p style='color:red;'>".$_SESSION['otp_error']."</p>";
    //     unset($_SESSION['otp_error']); // Remove the error after displaying it
    // }
    

</body>

</html>
