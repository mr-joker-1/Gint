<?php
// Connect to MySQL database
$mysqli = new mysqli('localhost', 'root', '2002', 'user_db');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if username already exists
$stmt_check = $mysqli->prepare("SELECT username FROM users WHERE username = ?");
$stmt_check->bind_param("s", $_POST['username']);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows > 0) {
    echo "Username already exists. Please try another one.";
} else {
    // Prepare statement
    $stmt_insert = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");

    // Bind parameters
    $stmt_insert->bind_param("ss", $_POST['username'], $_POST['password']);

    // Execute statement
    if ($stmt_insert->execute()) {
        echo "Registration successful";
    } else {
        echo "Error: " . $mysqli->error;
    }

    // Close insert statement
    $stmt_insert->close();
}

// Close check statement and connection
$stmt_check->close();
$mysqli->close();
?>

