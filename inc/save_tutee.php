<?php
// Database connection settings
$servername = 'localhost'; // Your server name
$username = 'root'; // Your database username
$password = 'patabang2024'; // Your database password
$dbname = 'patabang'; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO tutees (name, age, address, gender, program, mbti) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sissss", $name, $age, $address, $gender, $program, $mbti);

// Get data from the form
$name = $_POST['name'];
$age = $_POST['age'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$program = $_POST['program'];
$mbti = $_POST['mbti'];

// Execute the query and check if successful
if ($stmt->execute()) {
    $response = array(
        'status' => 'success',
        'message' => 'Data successfully saved!'
    );
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Error saving data: ' . $stmt->error
    );
}

// Close statement and connection
$stmt->close();
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>