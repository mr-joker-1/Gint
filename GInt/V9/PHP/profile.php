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
// Get POST data
$username = $redis->get('username');
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$dob = $_POST['dob'];

// Establish connection to MongoDB
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// Prepare document to be inserted
$document = [
    'username' => $username,
    'name' => $name,
    'email' => $email,
    'mobile' => $mobile,
    'dob' => $dob
];

// Specify the MongoDB collection
$collection = 'mydb.users';

// Insert document into MongoDB collection
$bulkWrite = new MongoDB\Driver\BulkWrite;
$bulkWrite->insert($document);

// Execute the bulk write operation
try {
    $result = $manager->executeBulkWrite($collection, $bulkWrite);
    echo "Profile saved successfully.";
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "Error saving profile: " . $e->getMessage();
}
?>


