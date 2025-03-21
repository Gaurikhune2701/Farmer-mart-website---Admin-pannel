<?php
include '../configuration/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';


    $uploaded_image_path = '';

    if (isset($_FILES['photos'])) {
        $file_name = $_FILES['photos']['name'];
        $file_tmp = $_FILES['photos']['tmp_name'];
        $file_size = $_FILES['photos']['size'];
        $file_error = $_FILES['photos']['error'];
        $file_type = $_FILES['photos']['type'];
    
        if ($file_error === UPLOAD_ERR_OK) {
            $upload_dir = 'uploads/blogs/';
            $file_path = $upload_dir . basename($file_name);
    
            if (move_uploaded_file($file_tmp, $file_path)) {
                $uploaded_image_path = $file_path;
            } else {
                echo json_encode(['error' => true, 'message' => 'Failed to upload image']);
                exit();
            }
        } else {
            echo json_encode(['error' => true, 'message' => 'Error in file upload']);
            exit();
        }
    }
    
    $image_path = $uploaded_image_path;

    $data = [
        'title' => $title,
        'image' => $image_path,
        'description' => $description  
    ];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $base_url . '/Routes/create_blog.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: PHPSESSID=q96nf2p41gsmm3kc8ql1orv1l9'
        ),
    ));

    $response = curl_exec($curl);
    
    if (curl_errno($curl)) {
        echo json_encode(['error' => true, 'message' => 'cURL Error: ' . curl_error($curl)]);
    } else {
        echo $response;
        $_SESSION['success_status'] = 'Blog has been added successfully.';
        echo "<script>
            window.location.href = '../View/blogsReport.php';
        </script>";
        // header("Location: ../View/blogsReport.php");
        // exit();
    }

    curl_close($curl);
} else {
    echo json_encode(['error' => true, 'message' => 'Invalid request method. Please submit the form properly.']);
}
?>
