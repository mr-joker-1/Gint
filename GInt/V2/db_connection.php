<?php
// MySQL database configuration
$mysql_host = 'localhost';
$mysql_username = 'root'; // Default MySQL username
$mysql_password = '2002'; // Default MySQL password
$mysql_database = 'user_db'; // Your MySQL database name

// MongoDB configuration
$mongo_host = 'localhost';
$mongo_port = '27017';
$mongo_database = 'user_db'; // Your MongoDB database name

// Connect to MySQL database
$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Connect to MongoDB database
try {
    $mongo_client = new MongoDB\Client("mongodb://$mongo_host:$mongo_port");
    $mongo_db = $mongo_client->$mongo_database;
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "MongoDB Connection error: " . $e->getMessage();
    exit;
}
?>