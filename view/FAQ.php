<?php
// @session_start();
include '../configuration/header.php';
include '../configuration/config.php';
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h5 class="mb-sm-0">FAQ</h5>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">FAQ</li>
                            </ol>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
            <!-- End page title -->

            <!-- <div class="row"> -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h3 class="card-title mb-0 flex-grow-1">FAQ</h3>
                            <a class="btn btn-primary" href="FAQ_report.php">FAQ Report</a>
                        </div><!-- End card header -->

                        <div class="card-body">
                            <div class="container mt-3">
                                <form action="FAQ_report.php" method="POST">
                                    <div class="mb-3">
                                        <label for="question" class="form-label">Question: <span style="color: red;">*</span></label>
                                        <input type="text" id="question" name="question" class="form-control" placeholder="Enter Your Question" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="answer" class="form-label">Answer: <span style="color: red;">*</span></label>
                                        <input type="text" id="answer" name="answer" class="form-control" placeholder="Enter Your Answer" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div><!-- End container -->
                        </div><!-- End card body -->
                    </div><!-- End card -->
                </div><!-- End col -->
            </div><!-- End row -->

        </div><!-- End container-fluid -->
    </div><!-- End page-content -->
</div><!-- End main-content -->


<?php include '../configuration/footer.php'; ?>

