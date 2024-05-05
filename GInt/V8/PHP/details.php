<?php

// Redis Cloud credentials
$redis_host = 'redis-11959.c212.ap-south-1-1.ec2.redns.redis-cloud.com';
$redis_port = '11959';
$redis_pass = 'vpK9EyoYFDBNRgsZcPuI2uc4lOf3th10';

// Connect to Redis Cloud
$redis = new Redis();
$redis->connect($redis_host, $redis_port);
$redis->auth($redis_pass);

// Get username from Redis
$username = $redis->get('username');

// Establish connection to MongoDB
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// Specify the MongoDB collection
$collection = 'mydb.users';

// Prepare MongoDB query
$filter = ['username' => $username];
$options = [];

// Execute MongoDB query
$query = new MongoDB\Driver\Query($filter, $options);
$cursor = $manager->executeQuery($collection, $query);

// Fetch user details from MongoDB cursor
$userDetails = [];
foreach ($cursor as $document) {
    $userDetails = [
        'username' => $document->username,
        'name' => $document->name,
        'email' => $document->email,
        'mobile' => $document->mobile,
        'dob' => $document->dob
    ];
}

// Send user details to JavaScript file
echo json_encode($userDetails);
?>
