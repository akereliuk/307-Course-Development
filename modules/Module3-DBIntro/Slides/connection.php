<?php

DEFINE('DB_USER', 'sample_dbadmin');
DEFINE('DB_PASSWORD', 'DsdvaKJPR');

try{

	// Make the connection
	$db = new PDO('mysql:host=localhost;dbname=sample_data;charset=utf8', DB_USER, DB_PASSWORD);
	
	// You must set this value so that exceptions are thrown
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (Exception $e) {

	echo "<p class='error'>There was a database problem: " . $e->getMessage() . "</p>";
	unset($db);
	
}

?>