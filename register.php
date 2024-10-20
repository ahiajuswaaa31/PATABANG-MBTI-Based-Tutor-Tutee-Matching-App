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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $age = $_POST["age"];
    $address = $_POST["address"];
    $gender = $_POST["gender"];
    $program = $_POST["program"];
    $mbti = $_POST["mbti"];

    // Query to insert data into the database
    $sql = "INSERT INTO tutees (name, age, address, gender, program, mbti) VALUES ('$name', '$age', '$address', '$gender', '$program', '$mbti')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>