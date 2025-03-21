<?php
// @session_start();
include '../configuration/header.php'; 
include '../configuration/config.php'; 
?>

<!-- Include necessary styles and scripts -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    .file-upload-label {
        display: inline-flex;
        align-items: center;
        cursor: pointer;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        padding: .375rem .75rem;
        background-color: #f8f9fa;
        font-size: 14px;
        width: 100%;
        max-width: 100%;
    }
    .file-upload-input {
        display: none; /* Hide the actual file input */
    }
    .file-upload-icon {
        margin-right: .5rem;
    }
    .form-control {
        width: 100%;
        box-sizing: border-box;
    }
    .card-body {
        padding: 1.5rem;
    }
    @media (max-width: 768px) {
        .file-upload-label {
            font-size: 12px; /* Adjust font size for smaller screens */
        }
    }
</style>

<main class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h5 class="mb-sm-0">Settings</h5>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Settings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End page title -->

            <?php
            if (isset($_SESSION['success_status'])) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Hey!</strong> ' . htmlspecialchars($_SESSION['success_status']) . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                unset($_SESSION['success_status']);
            } elseif (isset($_SESSION['error_status'])) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Hey!</strong> ' . htmlspecialchars($_SESSION['error_status']) . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                unset($_SESSION['error_status']);
            }
            ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h3 class="card-title mb-0 flex-grow-1">Settings</h3>
                        </div>
                        <!-- End card header -->

                        <div class="card-body">
                            <div class="live-preview">
                                <form action="../Controller/saveSetting.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <!-- App Logo -->
                                        <div class="col-md-6 mb-3">
                                            <label for="photos" class="form-label">APP Logo</label>
                                            <input type="file" id="photos" name="photos[]" class="form-control" accept="image/*" multiple>
                                        </div>

                                        <!-- App Name -->
                                        <div class="col-md-6 mb-3">
                                            <label for="app_name" class="form-label">App Name</label>
                                            <input type="text" class="form-control" id="app_name" name="app_name" placeholder="Enter app name" required>
                                        </div>

                                        <!-- Contact No -->
                                        <div class="col-md-6 mb-3">
                                            <label for="contact_no" class="form-label">Contact No</label>
                                            <input type="number" class="form-control" id="contact_no" name="contact_no" maxlength="10" placeholder="Enter contact number" required>
                                        </div>

                                        <!-- Email Id -->
                                        <div class="col-md-6 mb-3">
                                            <label for="email_id" class="form-label">Email Id</label>
                                            <input type="email" class="form-control" id="email_id" name="email_id" placeholder="Enter email address" required>
                                        </div>

                                        <!-- Website -->
                                        <div class="col-md-6 mb-3">
                                            <label for="website" class="form-label">Website</label>
                                            <input type="url" class="form-control" id="website" name="website" placeholder="Enter website URL" required>
                                        </div>

                                        <!-- Copyrights -->
                                        <div class="col-md-6 mb-3">
                                            <label for="copyrights" class="form-label">Copyrights</label>
                                            <input type="text" id="copyrights" name="copyrights" class="form-control" placeholder="Enter copyrights information" required>
                                        </div>

                                        <!-- Social Media Links -->
                                        <div class="col-md-6 mb-3">
                                            <label for="facebook_link" class="form-label">Facebook Link</label>
                                            <input type="url" id="facebook_link" name="facebook_link" class="form-control" placeholder="Enter Facebook link" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="whatsapp_link" class="form-label">WhatsApp Link</label>
                                            <input type="url" id="whatsapp_link" name="whatsapp_link" class="form-control" placeholder="Enter WhatsApp link" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="twitter_link" class="form-label">Twitter Link</label>
                                            <input type="url" id="twitter_link" name="twitter_link" class="form-control" placeholder="Enter Twitter link" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="linkedin" class="form-label">LinkedIn Link</label>
                                            <input type="url" id="linkedin" name="linkedin" class="form-control" placeholder="Enter LinkedIn link" required>
                                        </div>

                                        <!-- Save Button -->
                                        <div class="col-lg-12 text-end">
                                            <button type="submit" name="submit" class="btn btn-success">Save</button>
                                        </div>
                                    </div>
                                    <!-- End row -->
                                </form>
                            </div>
                        </div>
                        <!-- End card body -->
                    </div>
                    <!-- End card -->
                </div>
                <!-- End col-xxl-3 -->
            </div>
            <!-- End row -->
        </div>
    </div>
</main>

<?php include '../configuration/footer.php'; ?>
