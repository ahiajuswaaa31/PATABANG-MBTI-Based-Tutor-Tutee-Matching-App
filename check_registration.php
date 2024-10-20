<?php
// Database connection settings
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'patabang';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the name from the form
$name = $_POST['name'];

// Check if the user is already registered
$sql = "SELECT * FROM tutees WHERE name = '$name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User is registered, show top three tutors
    header('Location: show_top_tutors.php?name=' . urlencode($name));
} else {
    // User is not registered, redirect to registration page
    header('Location: register.html');
}

$conn->close();
?>