<?php
// Database connection credentials
$servername = "localhost"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "patabang"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ei_score = 0;
    $sn_score = 0;
    $tf_score = 0;
    $jp_score = 0;

    // Get the name of the tutee (Assuming it's in the POST data)
    $name = $_POST['name'];

    // Calculate scores for Extraversion vs Introversion
    $ei_score += $_POST['ei1'] === 'E' ? 1 : -1;
    $ei_score += $_POST['ei2'] === 'E' ? 1 : -1;
    $ei_score += $_POST['ei3'] === 'E' ? 1 : -1;

    // Calculate scores for Sensing vs Intuition
    $sn_score += $_POST['sn1'] === 'S' ? 1 : -1;
    $sn_score += $_POST['sn2'] === 'S' ? 1 : -1;
    $sn_score += $_POST['sn3'] === 'S' ? 1 : -1;
    $sn_score += $_POST['sn4'] === 'S' ? 1 : -1;

    // Calculate scores for Thinking vs Feeling
    $tf_score += $_POST['tf1'] === 'T' ? 1 : -1;
    $tf_score += $_POST['tf2'] === 'T' ? 1 : -1;
    $tf_score += $_POST['tf3'] === 'T' ? 1 : -1;
    $tf_score += $_POST['tf4'] === 'T' ? 1 : -1;

    // Calculate scores for Judging vs Perceiving
    $jp_score += $_POST['jp1'] === 'J' ? 1 : -1;
    $jp_score += $_POST['jp2'] === 'J' ? 1 : -1;
    $jp_score += $_POST['jp3'] === 'J' ? 1 : -1;
    $jp_score += $_POST['jp4'] === 'J' ? 1 : -1;

    // Determine MBTI type
    $mbti_type = '';
    if ($ei_score > 0) {
        $mbti_type .= 'E';
    } else {
        $mbti_type .= 'I';
    }

    if ($sn_score > 0) {
        $mbti_type .= 'S';
    } else {
        $mbti_type .= 'N';
    }

    if ($tf_score > 0) {
        $mbti_type .= 'T';
    } else {
        $mbti_type .= 'F';
    }

    if ($jp_score > 0) {
        $mbti_type .= 'J';
    } else {
        $mbti_type .= 'P';
    }

    // Prepare and bind SQL query to insert data into the table
    $stmt = $conn->prepare("INSERT INTO mbti_results (name, ei_score, sn_score, tf_score, jp_score, mbti_type) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siiiss", $name, $ei_score, $sn_score, $tf_score, $jp_score, $mbti_type);

    // Execute the query and check if successful
    if ($stmt->execute()) {
        echo "<script>alert('Data successfully saved! Your MBTI Type is: $mbti_type');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
