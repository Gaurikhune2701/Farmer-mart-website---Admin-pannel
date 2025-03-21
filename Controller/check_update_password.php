<?php
session_start();

include '../configuration/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    $password_pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

    if (!preg_match($password_pattern, $new_password)) {
        $_SESSION['error_status'] = 'Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.';
        echo "<script>
            window.location.href = '../view/update_password.php?email={$email}';
        </script>";
        exit();
    }

    $query = "SELECT password FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $current_password = $user['password'];

        if (!password_verify($password, $current_password)) {
            $_SESSION['error_status'] = 'Password incorrect. Please enter a valid password.';
            echo "<script>
                window.location.href = '../view/update_password.php?email={$email}';
            </script>";
            exit();
        } else {
            if ($new_password !== $confirm_password) {
                $_SESSION['error_status'] = 'Confirm password does not match the new password.';
                echo "<script>
                window.location.href = '../view/update_password.php?email={$email}';
            </script>";
            exit();
            } else {
                $data = array(
                    'email' => $email,
                    'password' => $new_password
                );

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $base_url . '/Routes/updatePassword_by_email.php',
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
                    echo $response;
                    $_SESSION['success_status'] = 'Password has been updated successfully.';
                    echo "<script>
                        window.location.href = '../view/index.php';
                    </script>";
                }

                curl_close($curl);
            }
        }
    } else {
        $_SESSION['error_status'] = 'Email not found.';
        echo "<script>
            window.location.href = '../view/update_password.php?email={$email}';
        </script>";
    }
} else {
    echo 'Invalid request method. Please submit the form properly.';
}
?>
