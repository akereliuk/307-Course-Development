<?php

include_once("db.php");

$objDB = connectDB();

$query = $objDB->prepare("SELECT table_name FROM information_schema.tables WHERE table_schema = '307'");
$query->execute();

$arrRow = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<html>
	<head>
		<title>DB Intro: Individual Assignment Sample Solution</title>
		<link rel="stylesheet" type="text/css" href="CSS/dbtables.css" media="screen" />
	</head>
	<body>
		<?php
			echo "<h3>Table List</h3>";
			echo "<ul>";

			foreach($arrRow as $arrTables){
				echo "<li><a href='show_tables.php?tablename=" . $arrTables['table_name'] . "'>" . $arrTables['table_name'] . "</a></li>";
			}

			echo "</ul>";
		?>
	</body>
</html>