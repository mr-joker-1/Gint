<?php
// MongoDB connection setup
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// Retrieve username from POST data
$username = $_POST['username'];

// MongoDB query to check if user details are present
$filter = ['username' => $username];
$query = new MongoDB\Driver\Query($filter);
$cursor = $manager->executeQuery('mydb.users', $query);

// Check if user details are present
if (count($cursor->toArray()) > 0) {
    // User details are present, return 'details_present'
    echo 'details_present';
} else {
    // User details are not present, return 'details_not_present'
    echo 'details_not_present';
}
?>
