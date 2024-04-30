<?php
include 'db.php';

// Handle AJAX request for user login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve hashed password from MySQL based on username
    $stmt = $mysqli->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();

    // Verify password
    if (password_verify($password, $hashedPassword)) {
        echo "Login successful";
        // Start a session and set session variables
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
}
?>
