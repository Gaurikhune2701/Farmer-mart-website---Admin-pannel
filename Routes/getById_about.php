
<?php

include 'config.php';

$data = json_decode(file_get_contents("php://input"), true);


    $id = $data['id'];

    $query = "SELECT * FROM tbl_about WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
      
      $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
      echo json_encode($data);
    } else {
      echo json_encode(['msg' => 'No Data!', 'status' => false]);
    }
    ?>