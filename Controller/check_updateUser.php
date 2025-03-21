<?php
@session_start();

include '../configuration/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $email = $_POST['email'] ?? '';
    
    // Fetch the current user's details based on ID
    $query = "SELECT email FROM user WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $current_email = $user['email'];

        // Check if the email is being changed
        if ($email !== $current_email) {
            // Check if the new email already exists in the database
            $email_check_query = "SELECT * FROM user WHERE email = '$email'";
            $email_check_result = mysqli_query($conn, $email_check_query);

            if (mysqli_num_rows($email_check_result) > 0) {
                // header('Location: ../view/edit_user.php?id=' . $id);
                $_SESSION['error_status'] = 'This email is already registered. Please use a different email.';

                echo "<script>
                    window.location.href = '../View/edit_user.php?id={$id}';
                </script>";
                exit();
            }
        }
    }

    $data = array(
        'id' => $id,
        'full_name' => $_POST['full_name'] ?? '',
        'designation' => $_POST['designation'] ?? '',
        'mobileNo' => $_POST['mobileNo'] ?? '',
        'email' => $email
    );

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $base_url . '/Routes/update_user.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        echo 'Error:' . curl_error($curl);
    } else {
        // echo $response;
        header('Location: ../view/userReport.php');
        $_SESSION['success_status'] = 'User data has been Updated successfully!';

    }

    curl_close($curl);

} else {
    echo 'Invalid request method. Please submit the form properly.';
}
?>
