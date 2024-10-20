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

// Get the name from the URL
$name = $_GET['name'];

// Query to select the top three tutors from the database
$sql = "SELECT * FROM tutors ORDER BY rating DESC LIMIT 3";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Tutor</title>
    <link rel="stylesheet" href="css/show_tutors.css">
</head>
<body>

<header>
    <h1>PATABANG</h1>
    <nav>
        <a class="button" href="index.html">HOME</a>
        <a class="button" href="#about">About Pat atabang</a>
        <a class="button" href="mbti_test.html">MBTI Test</a>
        <a class="button" href="register.html">Register</a>
        <a class="button" href="show_tutors.php">Tutors Available</a>
    </nav>
</header>

<h1>Select Your Tutor</h1>

<form action="save_match.php" method="post">
    <?php
    // Loop through each tutor in the result
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
            <div class="tutor-card">
                <img src="inc/unc.png" alt="<?php echo $row['name']; ?>">
                <h2><?php echo $row['name']; ?></h2>
                <p><strong>MBTI:</strong> <?php echo $row['mbti']; ?></p>
                <p><strong>Program:</strong> <?php echo $row['program']; ?></p>
                <p><strong>Availability:</strong> <?php echo $row['availability']; ?></p>
                <p><strong>Rating:</strong> <?php echo $row['rating']; ?></p>
                <input type="radio" name="tutor_id" value="<?php echo $row['id']; ?>">
            </div>
            <?php
        }
    } else {
        echo "No tutors found.";
    }
    ?>
    <input type="submit" value="Select Tutor">
</form>

<footer>
    <p>Developed by Sheila Mae Albalate and Joshua Ocariz<br>
       University of Nueva Caceres, Computer Engineering <br>
       Adviser: Engr. Christine Bautista, Dean of CEA</p>
</footer>

</body>
</html>

<?php
$conn->close();
?>