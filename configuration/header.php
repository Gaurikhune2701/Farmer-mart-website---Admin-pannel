<?php
@session_start();
if (!isset($_SESSION['UNAME']) ) {
    echo "<script>window.location.href='../view/login.php';</script>";
    // header("Location: ../view/login.php");
   // exit;
}
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">


<!-- Mirrored from themesbrand.com/velzon/html/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Jun 2023 09:36:47 GMT -->
<head>

    <meta charset="utf-8" />
    <title>Crop Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <link rel="shortcut icon" href="">
    <link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/layout.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

<style>
    .color{
        color:white;
    }
</style>

</head>
<body>
    <div id="layout-wrapper">

    <header id="page-topbar">
        <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index.php" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="assets\images\logo\crop_logo.jpg" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="assets\images\logo\crop_logo.jpg" alt="" height="17">
                        </span>
                    </a>

                    <a href="index.php" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="assets\images\logo\crop_logo.jpg" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="assets\images\logo\crop_logo.jpg" alt="" height="17">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->
            
            </div>

            <div class="d-flex align-items-center">
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                           <div class="d-flex">
                            <div>
                            <img class="rounded-circle header-profile-user" src="assets/images/users/pic3.png" alt="Header Avatar">
                            </div>
                            <div style="margin-bottom:-16px; margin-left:10px;">
                            <p>
                                <?php 
                                $email = $_SESSION['UNAME'];
                                // echo $email; 
                                $name = explode('@', $email)[0];
                                echo $name; 
                                ?><br>
                            </p>
                            </div>
                            </div>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="../view/profile_update.php"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">My Profile</span></a>
                        <a class="dropdown-item" href="../view/update_password.php"><i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Update Password</span></a>
                        <a class="dropdown-item" href="../view/logout.php"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout"> LogOut</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </header>


        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="index.php" class="logo logo-dark mt-2">
                    <span class="logo-sm">
                        <img src="assets\images\logo\crop_logo.jpg" alt="" >
                    </span>
                    <span class="logo-lg">
                         <img src="assets\images\logo\crop_logo.jpg" alt="" >
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="index.php" class="logo logo-light mt-2">
                    <span class="logo-sm">
                    <img src="assets\images\logo\crop_logo.jpg" alt="" style="height:70px;width:70px;border-radius: 39px;">
                    </span>
                    <span class="logo-lg">
                    <img src="assets\images\logo\crop_logo.jpg" alt="" style="height:70px;width:70px;border-radius: 39px;">
                    </span>
                  
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
                <p class="color mt-2">
                    <b class="fs-18"> Farmer Mart </b>
                </p>

            </div>

            <div id="scrollbar">
                <div class="container-fluid">
                    <div id="two-column-menu"></div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="ri-dashboard-line"></i><span>Menu</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link collapsed" href="#two" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMaps">
                            <i class="ri-creative-commons-by-fill"></i><span data-key="t-maps">Master Menu</span>
                            </a>
                            
                            <div class="menu-dropdown collapse " id="two" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="userReport.php" class="nav-link" data-key="t-google">Add User</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="categoryReport.php" class="nav-link" data-key="t-vector">Manage Categories</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="bannerReport.php" class="nav-link" data-key="t-vector">Add Banner</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link collapsed" href="#one" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMaps">
                            <i class="ri-apps-fill"></i><span data-key="t-maps">Crop Management</span>
                            </a>
                            
                            <div class="menu-dropdown collapse " id="one" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="CropManagement_Report.php" class="nav-link" data-key="t-google">Crop Report</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="CropDaywise_report.php" class="nav-link" data-key="t-vector">Crop Daily Report</a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="communityReport.php" target="_self" role="button" aria-expanded="false" aria-controls="sidebarLanding">
                                <i class="ri-community-line"></i> <span>Community Report</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="..\view\aboutUs_report.php " target="" role="button" aria-expanded="false" aria-controls="sidebarLanding">
                            <i class="ri-information-fill"></i><span>About Us</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="..\view\FAQ_report.php" target="_self" role="button" aria-expanded="false" aria-controls="sidebarLanding">
                            <i class="ri-at-line"></i><span>FAQ</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="..\view\terms_report.php" target="_self" role="button" aria-expanded="false" aria-controls="sidebarLanding">
                            <i class="ri-question-line"></i><span>Terms &Conditions</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="ticketReport.php" target="_self" role="button" aria-expanded="false" aria-controls="sidebarLanding">
                            <i class="ri-ticket-2-fill"></i><span>Support Ticket</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="blogsReport.php" target="_self" role="button" aria-expanded="false" aria-controls="sidebarLanding">
                            <i class="ri-newspaper-fill"></i><span>Blogs</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="contactDetailsReport.php" target="_self" role="button" aria-expanded="false" aria-controls="sidebarLanding">
                            <i class="ri-phone-fill"></i><span>Contact Details</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="SettingReport.php" target="_self" role="button" aria-expanded="false" aria-controls="sidebarLanding">
                                <i class="ri-settings-3-line"></i> <span>Settings</span>
                            </a>                          
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sidebar-background"></div>
        </div>

        <div class="vertical-overlay"></div>
    </div>
</body>

</html>
