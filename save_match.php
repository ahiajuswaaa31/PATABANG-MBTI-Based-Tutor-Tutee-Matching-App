<?php
require_once 'matching.php'
require_once 'db.php'

// Get the tutor and tutee IDs from the form
$tutor_id = $_POST['tutor_id']
$tutee_id = $_POST['tutee_id']

// Get the tutor and tutee data from the database
$tutor = getTutor($tutor_id)
$tutee = getTutee($tutee_id)

// Check if the match already exists
$existing_match = getMatch($tutor_id, $tutee_id)
if ($existing_match) {
echo "Match already exists."
exit
}

// Match the tutor to the tutee using the matching algorithm
$match = matchTutorToTutee($tutee['mbti'], array($tutor))

// Save the match to the database
saveMatch($match, $tutee_id)

// Redirect to the matches page
header('Location: matches.php')
exit

// Function to get a tutor from the database
function getTutor($id) {
$conn = connectToDatabase()
$query = "SELECT * FROM tutors WHERE id = '$id'"
$result = mysqli_query($conn, $query)
$tutor = mysqli_fetch_assoc($result)
mysqli_close($conn)
return $tutor
}

// Function to get a tutee from the database
function getTutee($id) {
$conn = connectToDatabase()
$query = "SELECT * FROM tutees WHERE id = '$id'"
$result = mysqli_query($conn, $query)
$tutee = mysqli_fetch_assoc($result)
mysqli_close($conn)
return $tutee
}

// Function to save a match to the database
function saveMatch($match, $tutee_id) {
$conn = connectToDatabase()
$query = "INSERT INTO matches (tutor_id, tutee_id) VALUES ('" . $match['id'] . "', '$tutee_id')"
mysqli_query($conn, $query)
mysqli_close($conn)
}

// Function to get a match from the database
function getMatch($tutor_id, $tutee_id) {
$conn = connectToDatabase()
$query = "SELECT * FROM matches WHERE tutor_id = '$tutor_id' AND tutee_id = '$tutee_id'"
$result = mysqli_query($conn, $query)
$match = mysqli_fetch_assoc($result)
mysqli_close($conn)
return $match
}
?>