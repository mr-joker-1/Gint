<?php
// Redis Cloud credentials
$redis_host = 'redis-11959.c212.ap-south-1-1.ec2.redns.redis-cloud.com';
$redis_port = '11959';
$redis_pass = 'vpK9EyoYFDBNRgsZcPuI2uc4lOf3th10';

// Connect to Redis Cloud
$redis = new Redis();
$redis->connect($redis_host, $redis_port);
$redis->auth($redis_pass);

// Retrieve token from request
$token = $_POST['token'] ?? '';

// Check if token is present
if (empty($token)) {
    // Token is not present
    echo json_encode(["valid" => false]);
    exit();
}

// Validate token against Redis
$stored_token = $redis->get('token');
if ($stored_token === $token) {
    // Token is valid
    echo json_encode(["valid" => true]);
} else {
    // Token is invalid
    echo json_encode(["valid" => false]);
}
