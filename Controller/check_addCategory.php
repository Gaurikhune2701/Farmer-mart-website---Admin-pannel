<?php
include '../configuration/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = $_POST['category_name'] ?? '';
    $category_status = $_POST['category_status'] ?? '';
    $category_description = $_POST['category_description'] ?? '';

    $uploaded_image_paths = [];
    if (isset($_FILES['photos'])) {
        $total_files = count($_FILES['photos']['name']);
        for ($i = 0; $i < $total_files; $i++) {
            $file_name = $_FILES['photos']['name'][$i];
            $file_tmp = $_FILES['photos']['tmp_name'][$i];
            $file_size = $_FILES['photos']['size'][$i];
            $file_error = $_FILES['photos']['error'][$i];
            $file_type = $_FILES['photos']['type'][$i];

            if ($file_error === UPLOAD_ERR_OK) {
                $upload_dir = '../uploads/category/';
                $file_path = $upload_dir . basename($file_name);
                if (move_uploaded_file($file_tmp, $file_path)) {
                    $uploaded_image_paths[] = $file_path;
                } else {
                    echo json_encode(['error' => true, 'message' => 'Failed to upload image']);
                    exit();
                }
            }
        }
    }

    $image_paths = implode(',', $uploaded_image_paths);

    $data = [
        'category_name' => $category_name,
        'status' => $category_status,
        'description' => $category_description,
        'image' => $image_paths,
    ];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $base_url . '/Routes/create_category.php',
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
        $_SESSION['success_status'] = 'Category has been added successfully.';
        echo "<script>
            window.location.href = '../View/categoryReport.php';
        </script>";
        // header("Location: ../View/categoryReport.php");
        // exit();

    }

    curl_close($curl);
} else {
    echo json_encode(['error' => true, 'message' => 'Invalid request method. Please submit the form properly.']);
}
?>
