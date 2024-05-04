<?php
// Get POST data
$username = $_POST['userame'];
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


