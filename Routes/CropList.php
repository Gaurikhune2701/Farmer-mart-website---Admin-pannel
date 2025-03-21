<?php
include '../configuration/config.php';

$sql = "select * from crop_management";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
   $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

  echo json_encode($data);
} else {
  echo json_encode(['msg' => 'No Data!', 'status' => false]);
}


?>