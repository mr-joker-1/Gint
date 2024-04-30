<?php
// Check credentials from MySQL database
$mysqli = new mysqli('localhost', 'root', '2002', 'user_db');
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $_POST['username']);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    // Username exists, check password
    $row = $result->fetch_assoc();
    if ($_POST['password'] == $row['password']) {
        // Login successful
        echo "success";
    } else {
        // Invalid password
        echo "error";
    }
} else {
    // Username does not exist
    echo "error";
}

$stmt->close();
$mysqli->close();
?>
