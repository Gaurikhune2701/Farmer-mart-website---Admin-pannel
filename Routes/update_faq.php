<?php

include '../configuration/config.php'; 

$id=$data['id'];
$question=$data['question'];
$answer=$data['answer'];




$sql="UPDATE tbl_faq SET id='$id',question='$question',answer='$answer' WHERE id='$id' ";

if (mysqli_query($conn, $sql)) {
  echo json_encode(['msg' => 'Data Updated Successfully!', 'status' => true]);
} else {
  echo json_encode(['msg' => 'Data Failed to be Updated!', 'status' => false]);
}



?>