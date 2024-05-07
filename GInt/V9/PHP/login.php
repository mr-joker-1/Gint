<?php

$token = bin2hex(random_bytes(32));
// Redis Cloud credentials
$redis_host = 'redis-11959.c212.ap-south-1-1.ec2.redns.redis-cloud.com';
$redis_port = '11959';
$redis_pass = 'vpK9EyoYFDBNRgsZcPuI2uc4lOf3th10';

// Connect to Redis Cloud
$redis = new Redis();
$redis->connect($redis_host, $redis_port);
$redis->auth($redis_pass);

// Set info in Redis
$redis->set('username', $_POST['username']);
$redis->set('time', date('Y-m-d H:i:s'));
$redis->set('token', $token);

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
        echo json_encode(array("status" => "success", 'token' => $token));
    } else {
        // Invalid password
        echo json_encode(array("status" => "error"));
    }
} else {
    // Username does not exist
    echo json_encode(array("status" => "error"));
}

$stmt->close();
$mysqli->close();
?>
