<?php
// MySQL connection
$mysqli = new mysqli('localhost', 'username', 'password', 'database_name');
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

// MongoDB connection
$client = new MongoDB\Client('mongodb://localhost:27017');
$mongoDB = $client->selectDatabase('your_database_name');
?>
