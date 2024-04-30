<?php
include 'db.php';

// Handle AJAX request for user registration
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Validate input (e.g., check for empty fields)

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute MySQL statement
    $stmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Registration successful";
    } else {
        echo "Registration failed";
    }

    $stmt->close();
}
?>
