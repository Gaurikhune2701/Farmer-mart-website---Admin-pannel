<?php

include 'config.php';



//$id=$data['id'];
$question=$data['question'];
$answer=$data['answer'];



 $sql = "insert into tbl_faq(question,answer) 
 values ('$question','$answer')";



if (mysqli_query($conn, $sql)) {
  header('Content-Type: application/json');
  echo json_encode(['success' => true, 'message' => 'data created successfully']);
} else {
  
  echo json_encode(['Error' => false, 'message' => 'Data Failed to be Inserted!']);
}






?>