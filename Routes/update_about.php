<?php

include 'config.php';

$id=$data['id'];
$about=$data['about'];

echo $sql="UPDATE tbl_about SET id='$id',about='$about' WHERE id='$id' ";

if (mysqli_query($conn, $sql)) {
  echo json_encode(['msg' => 'Data Updated Successfully!', 'status' => true]);
} else {
  echo json_encode(['msg' => 'Data Failed to be Updated!', 'status' => false]);
}


?>