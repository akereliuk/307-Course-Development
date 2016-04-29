<?php

include_once("db.php");

$objDB = connectDB();

$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : "ASC";

?>

<html>
	<head>
		<title>DB Intro: Individual Assignment Sample Solution</title>
		<link rel="stylesheet" type="text/css" href="CSS/dbtables.css" media="screen" />
	</head>
	<body>
		<h1>Enrollment Table</h1>
		<p>Sort Last Names in: <a href='index.php?sort_order=ASC'>Ascending</a> / <a href='index.php?sort_order=DESC'>Descending</a> Order</p>
		<table>
			<tr>
				<th>Last Name</th>
				<th>First Name</th>
				<th>Birthdate</th>
				<th>Phone Number</th>
				<th>Address</th>
				<th>Date Enrolled</th>
			</tr>
			<?php				
				$query = $objDB->prepare("SELECT LastName, FirstName, Birthdate, PhoneNumber, Address, DateEnrolled FROM Enrollment ORDER BY LastName {$sort_order}");
				$query->execute();
				$arrRow = $query->fetchAll(PDO::FETCH_ASSOC);
				
				foreach($arrRow as $tableRows){
					$arrColumnValues = array_values($tableRows);
					
					echo "<tr>";
					
					for($i = 0; $i<sizeof($arrColumnValues); $i++){
						echo "<td>" . $arrColumnValues[$i] . "</td>";
					}
					
					echo "</tr>";
				}
				
				echo "</table>";
			?>
	</body>
</html>