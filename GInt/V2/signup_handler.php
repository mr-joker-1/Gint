<?php
require_once('db_connection.php');

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $mysqli->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $password);

if($stmt->execute()){
    echo "Signup successful";
} else {
    echo "Error: " . $mysqli->error;
}

$stmt->close();
$mysqli->close();
?>
