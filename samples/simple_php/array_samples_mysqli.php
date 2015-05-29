<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Fetch Data from MySQL using SELECT</title>
<style>
td, th {
 padding: 5px;
 border: 1px solid grey;
}
th {
  background-color: lightgrey;
}
</style>
</head>
<body>
<h1>Getting Values from a Database</h1>
<?php
//-------------------------------------------------------------------------------------

$mysqli = @new mysqli("localhost", "steve_student", "60307dB", "steve_60307");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$query = "SELECT * FROM us_states ORDER BY state_name";
$result = $mysqli->query($query);

// CODE HERE

/* free result set */
$result->free();

/* close connection */
$mysqli->close();
?>
</body>
</html>





















<?php 

// SAMPLE CODE BELOW



// (1) DISPLAY THE HEADER ROW using the COLUMNS FROM THE DATABASE

/* Fetch all of the values into an associative array -- this is not efficient */
/* 
$all_data = $result->fetch_all(MYSQLI_ASSOC);  // this will return an array of arrays.  (rows, columns)
$col_names = array_keys($all_data[0]); // get the keys from the first row
echo "<table><tr>";
foreach ($col_names as $col)
    echo "<th>$col</th>";
echo "</tr></table>";
*/




// (2) DISPLAY TWO COLUMNS FROM THE DATABASE


/*

$all_data = $result->fetch_all(MYSQLI_ASSOC);  // this will return an array of arrays.  (rows, columns)
echo "<table>";
echo "<tr><th>State Name</th><th>Capital City</th></tr>";
foreach ($all_data as $state) {
   echo "<tr>";
   echo "<td>{$state['state_name']}</td><td>{$state['capital']}</td>";
   echo "</tr>";
}
echo "</table>";
	
*/

// (3)  ROW AT A TIME PROCESSING
	
/*

if ($result) {
	echo "<table>";
    echo "<tr><th>State Name</th><th>Capital City</th></tr>";
	
    while($state = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>{$state['state_name']}</td><td>{$state['capital']}</td>";
      echo "</tr>";
    }
    echo "</table>";
}

*/