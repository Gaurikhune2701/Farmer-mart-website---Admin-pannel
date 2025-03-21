<?php
session_start();

include '../configuration/config.php';

if ( $_SERVER['REQUEST_METHOD'] === 'POST') {

    // $uploaded_image_paths = [];
    // if (isset($_FILES['photos']) && !empty(($_FILES['photos']))) {
    //     $total_files = count($_FILES['photos']['name']);
    //     for ($i = 0; $i < $total_files; $i++) {
    //         $file_name = $_FILES['photos']['name'][$i];
    //         $file_tmp = $_FILES['photos']['tmp_name'][$i];
    //         $file_size = $_FILES['photos']['size'][$i];
    //         $file_error = $_FILES['photos']['error'][$i];
    //         $file_type = $_FILES['photos']['type'][$i];

    //         if ($file_error === UPLOAD_ERR_OK) {
    //             $upload_dir = 'assets/images/category/';
    //             $file_path = $upload_dir . basename($file_name);
    //             if (move_uploaded_file($file_tmp, $file_path)) {
    //                 $uploaded_image_paths[] = $file_path;
    //             } else {
    //                 echo json_encode(['error' => true, 'message' => 'Failed to upload image']);
    //                 exit();
    //             }
    //         }
    //     }
    // }

    // $image_paths = implode(',', $uploaded_image_paths);
    $sr_no = $_POST['sr_no'] ?? '';
    $category_name = $_POST['category_name'] ?? '';
    $category_status = $_POST['category_status'] ?? '';
    $category_description = $_POST['category_description'] ?? '';
    $current_image = $_POST['current_image'];

    if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] == 0) {
        $image_name = $_FILES['new_image']['name'];
        $image_tmp_name = $_FILES['new_image']['tmp_name'];
        $image_folder = '../uploads/category/' . $image_name;
        
        move_uploaded_file($image_tmp_name, $image_folder);

        $image = $image_folder;
    } else {
        $image = $current_image;
    }

    $data = array(
        'sr_no' => $sr_no,
        'category_name' => $category_name,
        'status' => $category_status,
        'image' => $image,
        'description' => $category_description
    );
    

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $base_url . '/Routes/update_category.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => array(
        'Cookie: PHPSESSID=23qs3lg9d5o1eg88pd95n38gns'
      ),
    ));
    
    echo $response = curl_exec($curl);


    if (curl_errno($curl)) {
        echo 'Error:' . curl_error($curl);
    } else {
        echo $response;
        $_SESSION['success_status'] = 'Category has been updated successfully.';
        echo "<script>
                window.location.href = '../View/categoryReport.php';
            </script>";
    }

    curl_close($curl);
} else {
    echo 'Invalid request method. Please submit the form properly.';
}
?>
