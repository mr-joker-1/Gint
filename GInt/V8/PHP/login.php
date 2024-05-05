<?php
// Redis Cloud credentials
$redis_host = 'redis-11959.c212.ap-south-1-1.ec2.redns.redis-cloud.com';
$redis_port = '11959';
$redis_pass = 'vpK9EyoYFDBNRgsZcPuI2uc4lOf3th10';

// Con$redis = new Redis();nect to Redis Cloud

$redis = new Redis();
$redis->connect($redis_host, $redis_port);
$redis->auth($redis_pass);

// Set Redis as the session handler
ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://'. $redis_host. ':'. $redis_port);
//Session Data
$redis->set('username', $_POST['username']);
$redis->set('time', date('Y-m-d H:i:s'));
$redis->set('date', date('Y-m-d'));
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
