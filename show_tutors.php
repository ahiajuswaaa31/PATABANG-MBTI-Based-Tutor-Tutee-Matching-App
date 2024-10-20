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

// Query to select all tutors from the database
$sql = "SELECT * FROM tutors";
$result = $conn->query($sql);

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/show_tutors.css">
    <title>Show Tutors</title>
</head>
<body>
    <header>
        <h1>PATABANG</h1>
        <nav>
                <a class="button" href="index.html">HOME</a>
                <a class="button" href="#about">About Patabang</a>
                <a class="button" href="mbti_test.html">MBTI Test</a>
                <a class="button" href="register.html">Register</a>
                <a class="button" href="show_tutors.html">Tutors Available</a>
        </nav>
    </header>
    
    <main>
        <h1>Tutors</h1>
        <div class="tutors-container">
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
                    </div>
                    <?php
                }
            } else {
                echo "No tutors found.";
            }
            ?>
        </div>
    </main>
    <footer>
        <p>Developed by Sheila Mae Albalate and Joshua Ocariz<br>
           University of Nueva Caceres, Computer Engineering <br>
           Adviser: Engr. Christine Bautista, Dean of CEA</p>
    </footer>
</body>
</html>