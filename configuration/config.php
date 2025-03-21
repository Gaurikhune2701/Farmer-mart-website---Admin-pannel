<?php
@session_start();
$base_url='localhost/CropManageSystem';


// Read and decode JSON data from the request body
$data = json_decode(file_get_contents("php://input"), true);

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'farmer_mart');

// Check for database connection errors
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    // echo "Database connection successful!";
}

// $_SESSION["email"]='123';
// $email=$_SESSION["email"];
?>

