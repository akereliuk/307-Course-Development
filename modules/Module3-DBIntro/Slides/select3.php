<?php

DEFINE('DB_USER', 'sample_dbadmin');
DEFINE('DB_PASSWORD', 'DsdvaKJPR');

// Make the connection
$db = new PDO('mysql:host=localhost;dbname=sample_data;charset=utf8', DB_USER, DB_PASSWORD);

// Prepare the query
$result = $db->prepare("SELECT * FROM us_states");

if($result){
	echo "<table>";
	echo "<tr><th>State Name</th><th>Capital City</th></tr>";
	
	while($state = $result->fetchAll(PDO::FETCH_ASSOC)){
		echo "<tr>";
		echo "<td>{$state['state_name']}</td><td>{$state['capital']}</td>";
		echo "</tr>";
	}
	echo "</table>";
}

// Free result set
$result->closeCursor();

// Close DB connection
$db->close();

?>