<?php

include 'config.php';



//$id=$data['id'];
$about=$data['about'];


 $sql = "insert into tbl_about(about) values ('$about')";



if (mysqli_query($conn, $sql)) {
  header('Content-Type: application/json');
  echo json_encode(['success' => true, 'message' => 'data created successfully']);
} else {
  
  echo json_encode(['Error' => false, 'message' => 'Data Failed to be Inserted!']);
}






?>