<?php
session_start();

include '../configuration/config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];

    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error_status'] = 'This email is already registered. Please use a different email.';

        echo "<script>
            window.location.href = '../View/addUser.php';
        </script>";
        exit();

    } else {

    $full_name = $_POST['full_name'];
    $designation = $_POST['designation'];
    $mobileNo = $_POST['mobileNo'];
    // $email = $_POST['email'];
    $password = $_POST['password'];

    $data = array(
        'full_name' => $full_name,
        'designation' => $designation,
        'mobileNo' => $mobileNo,
        'email' => $email,
        'password' => $password
    );

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $base_url . '/Routes/create_user.php',
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
        $_SESSION['success_status'] = 'User has been added successfully.';
        echo "<script>
            window.location.href = '../View/userReport.php';
        </script>";
        // header("Location: ../View/userReport.php");
        // exit();
    }

    curl_close($curl);
    }
} else {
    echo "Invalid Request Method";
}
