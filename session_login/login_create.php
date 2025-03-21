<?php
// include("config.php");
// @session_start();

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// // Check if the form is submitted
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     if (isset($_POST['username'], $_POST['password'])) {
//         $username = mysqli_real_escape_string($conn, $_POST['username']);
//         $password = $_POST['password'];

//         $query = "SELECT * FROM `user` WHERE `email` = '$username'";
//         $result = mysqli_query($conn, $query);

//         if ($result) {
//             echo "Query successful. Rows found: " . mysqli_num_rows($result); // Debugging line
//             if (mysqli_num_rows($result) == 1) {
//                 $user = mysqli_fetch_assoc($result);
//                 if (password_verify($password, $user['password'])) {
//                     $_SESSION['user_name'] = $username;
//                     echo "User logged in: " . $_SESSION['user_name']; // Debugging line
//                     header('Location:index.php');
//                     exit();
//                 } else {
//                     $_SESSION['error'] = "Invalid password. Please try again.";
//                     header('Location: login.php');
//                     exit();
//                 }
//             } else {
//                 $_SESSION['error'] = "Invalid username. Please try again.";
//                 header('Location: login.php');
//                 exit();
//             }
//         } else {
//             echo "Query failed: " . mysqli_error($conn); // Show error if query fails
//         }
//     } else {
//         echo "Username or password not set";
//     }
// } else {
//     header('Location: login.php');
//     exit();
// }
?>
