<?php include '../configuration/header.php';
include '../configuration/config.php';

if(!isset($_SESSION['IS_LOGIN'])){
	header('location:login.php');
	die();
}
// echo "Welcome ".$_SESSION['UNAME'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'localhost/CropManageSystem/Routes/get_userCount.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=8nhh7k3b4lpfgv124kfpq0kv6f'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
$user_data = json_decode($response);


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'localhost/CropManageSystem/Routes/get_cropCount.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=8nhh7k3b4lpfgv124kfpq0kv6f'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
$crop_data = json_decode($response);


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'localhost/CropManageSystem/Routes/get_cropDaywiseCount.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=8nhh7k3b4lpfgv124kfpq0kv6f'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
$daywise_data = json_decode($response);


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'localhost/CropManageSystem/Routes/get_categoryCount.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=8nhh7k3b4lpfgv124kfpq0kv6f'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
$category_data = json_decode($response);


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'localhost/CropManageSystem/Routes/get_bannerCount.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=8nhh7k3b4lpfgv124kfpq0kv6f'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
$banner_data = json_decode($response);


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'localhost/CropManageSystem/Routes/get_communityCount.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=8nhh7k3b4lpfgv124kfpq0kv6f'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
$community_data = json_decode($response);



$user_count = $user_data[0]->user_count ?? 'N/A';
$crop_count = $crop_data[0]->crop_count ?? 'N/A';
$daywise_count = $daywise_data[0]->daywise_count ?? 'N/A';
$category_count = $category_data[0]->category_count ?? 'N/A';
$banner_count = $banner_data[0]->banner_count ?? 'N/A';
$community_count = $community_data[0]->community_count ?? 'N/A';
$DistributionStockWhereRoundNameIsPresent = $data->DistributionStockWhereRoundNameIsPresent ?? 'N/A';
$AvailableStockWhereWeaponNameIsPresent = $data->AvailableStockWhereWeaponNameIsPresent ?? 'N/A';
$TotalStockWhereWeaponNameIsPresent = $data->TotalStockWhereWeaponNameIsPresent ?? 'N/A';

$errorMessage = empty($data) ? "Unable to fetch data" : "";
?>

<script src="../view/assets/js/alert_timeout.js"></script>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between                 bg-galaxy-transparent">
                        <h5 class="mb-sm-0" ><b>Farmer Mart Dashboard</b></h5>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">Farmar mart</li>
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

            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-lg-3">

                    <div class="col">
                        <div class="card card-animate overflow-hidden">
                            <div class="position-absolute start-0" style="z-index: 0;">
                                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                    <style>
                                        .s0 {
                                            opacity: .05;
                                            fill: var(--vz-success)
                                                }
                                    </style>
                                    <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z"></path>
                                </svg>
                            </div>
                            <div class="card-body" style="z-index:1 ;">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Crop <br>Report</p>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-0"><span class="counter-value" data-target="<?php echo $crop_count; ?>"><?php echo $crop_count; ?></span></h4>
                                    </div>

                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>

                    <div class="col">
                        <div class="card card-animate overflow-hidden">
                            <div class="position-absolute start-0" style="z-index: 0;">
                                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                    <style>
                                        .s0 {
                                            opacity: .05;
                                            fill: var(--vz-success)
                                                }
                                    </style>
                                    <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z"></path>
                                </svg>
                            </div>
                            <div class="card-body" style="z-index:1 ;">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Crop Daywise<br>Report</p>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-0"><span class="counter-value" data-target="<?php echo $daywise_count; ?>"><?php echo $daywise_count; ?></span></h4>
                                    </div>

                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>

                    <div class="col">
                        <div class="card card-animate overflow-hidden">
                            <div class="position-absolute start-0" style="z-index: 0;">
                                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                    <style>
                                        .s0 {
                                            opacity: .05;
                                            fill: var(--vz-success)
                                                }
                                    </style>
                                    <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z"></path>
                                </svg>
                            </div>
                            <div class="card-body" style="z-index:1 ;">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Crop Category<br> Report</p>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-0"><span class="counter-value" data-target="<?php echo $category_count; ?>"><?php echo $category_count; ?></span></h4>
                                    </div>

                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>

                    <div class="col">
                        <div class="card card-animate overflow-hidden">
                            <div class="position-absolute start-0" style="z-index: 0;">
                                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                    <style>
                                        .s0 {
                                            opacity: .05;
                                            fill: var(--vz-success)
                                                }
                                    </style>
                                    <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z"></path>
                                </svg>
                            </div>
                            <div class="card-body" style="z-index:1 ;">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Customer<br> Report</p>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-0"><span class="counter-value" data-target="<?php echo $user_count; ?>"><?php echo $user_count; ?></span></h4>
                                    </div>

                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>

                    <div class="col">
                        <div class="card card-animate overflow-hidden">
                            <div class="position-absolute start-0" style="z-index: 0;">
                                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                    <style>
                                        .s0 {
                                            opacity: .05;
                                            fill: var(--vz-success)
                                                }
                                    </style>
                                    <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z"></path>
                                </svg>
                            </div>
                            <div class="card-body" style="z-index:1 ;">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Total Banner<br> Report</p>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-0"><span class="counter-value" data-target="<?php echo $banner_count; ?>"><?php echo $banner_count; ?></span></h4>
                                    </div>

                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>

                    <div class="col">
                        <div class="card card-animate overflow-hidden">
                            <div class="position-absolute start-0" style="z-index: 0;">
                                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                    <style>
                                        .s0 {
                                            opacity: .05;
                                            fill: var(--vz-success)
                                                }
                                    </style>
                                    <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z"></path>
                                </svg>
                            </div>
                            <div class="card-body" style="z-index:1 ;">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Total Community<br> Posts</p>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-0"><span class="counter-value" data-target="<?php echo $community_count; ?>"><?php echo $community_count; ?></span></h4>
                                    </div>

                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>


                    <!-- <div class="col">
                        <div class="card card-animate overflow-hidden">
                            <div class="position-absolute start-0" style="z-index: 0;">
                                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                    <style>
                                        .s0 {
                                            opacity: .05;
                                            fill: var(--vz-success)
                                                }
                                    </style>
                                    <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z"></path>
                                </svg>
                            </div>
                            <div class="card-body" style="z-index:1 ;">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Expired Weapon<br> Stock</p>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-0"><span class="counter-value" data-target="<?php echo $ExpiredWeaponStock; ?>"><?php echo $ExpiredWeaponStock; ?></span></h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-animate overflow-hidden">
                            <div class="position-absolute start-0" style="z-index: 0;">
                                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                    <style>
                                        .s0 {
                                            opacity: .05;
                                            fill: var(--vz-success)
                                                }
                                    </style>
                                    <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z"></path>
                                </svg>
                            </div>
                            <div class="card-body" style="z-index:1 ;">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Expired Round<br> Stock</p>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-0"><span class="counter-value" data-target="<?php echo $ExpiredRoundStock; ?>"><?php echo $ExpiredRoundStock; ?></span></h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> -->


                  



                </div>
            </div>
            
        </div>
    </div>
</div>

<?php include '../configuration/footer.php' ?>