<?php

DEFINE('DB_USER', 'sample_dbadmin');
DEFINE('DB_PASSWORD', 'DsdvaKJPR');

try{

	// Make the connection
	$db = new PDO('mysql:host=localhost;dbname=sample_data;charset=utf8', DB_USER, DB_PASSWORD);
	
	// You must set this value so that exceptions are thrown
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$result = $db->prepare("SELECT * FROM event");
	// $result is an object of type PDOStatement that has properties and methods
	
	if($result->num_rows == 0){
		echo "<p>No results were found.</p>";
	}
	else{
		echo "<table><tr><th>ID</th><th>Name</th><tr>";
		$data_array = $result->fetchAll(PDO::FETCH_ASSOC);
		foreach($data_array as $row){
			echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td></tr>";
		}
		echo "</table>";
	}
	
	$db->close();

} catch (Exception $e) {

	echo "<p class='error'>There was a database problem: " . $e->getMessage() . "</p>";
	unset($db);
	
}

?>