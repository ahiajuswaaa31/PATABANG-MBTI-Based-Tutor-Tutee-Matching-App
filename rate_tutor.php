<?php
// Database connection settings
$servername = 'localhost'; // Your server name
$username = 'root'; // Your database username
$password = ''; // Your database password
$dbname = 'patabang'; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to select the tutor's ID from the matches table
$tutee_id = $_SESSION['tutee_id'];
$sql = "SELECT tutor_id FROM matches WHERE tutee_id = '$tutee_id'";
$result = $conn->query($sql);
$tutor_id = $result->fetch_assoc()['tutor_id'];

// Query to select the tutor's current rating from the tutors table
$sql = "SELECT rating FROM tutors WHERE id = '$tutor_id'";
$result = $conn->query($sql);
$current_rating = $result->fetch_assoc()['rating'];

// Calculate the new rating
$new_rating = ($current_rating + $_POST['rating']) / 2;

// Update the tutor's rating in the tutors table
$sql = "UPDATE tutors SET rating = '$new _rating' WHERE id = '$tutor_id'";
$conn->query($sql);

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate Your Tutor</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header>
    <h1>PATABANG</h1>
    <nav>
        <a class="button" href="index.html">HOME</a>
        <a class="button" href="#about">About Patabang</a>
        <a class="button" href="mbti_test.html">MBTI Test</a>
        <a class="button" href="register.html">Register</a>
        <a class="button" href="show_tutors.php">Tutors Available</a>
    </nav>
</header>

<h1>Rate Your Tutor</h1>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="rating">Rating (1-5):</label>
    <input type="number" id="rating" name="rating" min="1" max="5" required>
    <input type="submit" value="Rate Tutor">
</form>

<footer>
    <p>Developed by Sheila Mae Albalate and Joshua Ocariz<br>
       University of Nueva Caceres, Computer Engineering <br>
       Adviser: Engr. Christine Bautista, Dean of CEA</p>
</footer>

</body>
</html>