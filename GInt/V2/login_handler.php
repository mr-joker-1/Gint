<?php
require_once('db_connection.php');

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $mysqli->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($hashed_password);
$stmt->fetch();

if(password_verify($password, $hashed_password)){
    echo "success";
} else {
    echo "error";
}

$stmt->close();
$mysqli->close();
?>
