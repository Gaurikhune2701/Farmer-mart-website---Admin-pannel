<?php 
include '../configuration/config.php'; 


$id=$data['id'];
$terms=$data['terms'];


$sql="UPDATE tbl_terms SET id='$id',terms='$terms' WHERE id='$id' ";

if (mysqli_query($conn, $sql)) {
  echo json_encode(['msg' => 'Data Updated Successfully!', 'status' => true]);
} else {
  echo json_encode(['msg' => 'Data Failed to be Updated!', 'status' => false]);
}


?>
