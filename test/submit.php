<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$host = 'localhost';  // Database host
$dbname = 'test_db';   // Database name
$username = 'root';    // Database username
$password = '';        // Database password

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$user_name = $_POST['username'];
$user_email = $_POST['email'];

print_r($_POST);

if ($conn) {
    echo "Connected successfully!";
} else {
    echo "Connection failed!";
}

// Insert data into the database
$sql = "INSERT INTO users (username, email) VALUES (?, ?)";

// Prepare and bind
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $user_name, $user_email);

if ($stmt->execute()) {
    echo "New record created successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
