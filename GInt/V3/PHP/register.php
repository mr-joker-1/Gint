<?php
// Connect to MySQL database
$mysqli = new mysqli('localhost', 'root', '2002', 'user_db');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Prepare statement
$stmt = $mysqli->prepare("INSERT INTO users (username) VALUES (?)");
$stmt->bind_param("s", $_POST['username']);

// Execute statement
if ($stmt->execute()) {
    echo "Registration successful";
} else {
    echo "Error: " . $mysqli->error;
}

// Close statement and connection
$stmt->close();
$mysqli->close();
?>
