<?php

DEFINE('DB_USER', 'sample_dbadmin');
DEFINE('DB_PASSWORD', 'DsdvaKJPR');

// Make the connection
$db = new PDO('mysql:host=localhost;dbname=sample_data;charset=utf8', DB_USER, DB_PASSWORD);

// Prepare the query
$result = $db->prepare("SELECT * FROM us_states");

// ADDITIONAL CODE HERE

// Free result set
$result->closeCursor();

// Close DB connection
$db->close();

?>