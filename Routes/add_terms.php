<?php

include 'config.php';

//$id=$data['id'];
$terms=$data['terms'];




 $sql = "insert into tbl_terms(terms) 
 values ('$terms')";



if (mysqli_query($conn, $sql)) {
  header('Content-Type: application/json');
  echo json_encode(['success' => true, 'message' => 'data created successfully']);
} else {
  
  echo json_encode(['Error' => false, 'message' => 'Data Failed to be Inserted!']);
}






?>