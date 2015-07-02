<?php

include_once("db.php");

?>

<html>
	<head>
		<title>DB Intro: Individual Assignment Sample Solution</title>
		<link rel="stylesheet" type="text/css" href="CSS/dbtables.css" media="screen" />
	</head>
	<body>
		<?php
		
			if(isset($_GET['tablename'])){
				$objDB = connectDB();
				$tableName = $_GET['tablename'];

				$query = $objDB->prepare("DESCRIBE {$tableName}");
				$query->execute();
				$tableColumns = $query->fetchAll(PDO::FETCH_COLUMN);
				
				echo "<table>";
				
				for ($i=0; $i<sizeof($tableColumns); $i++){
					echo "<th>" . $tableColumns[$i] . "</th>";
				}
				
				$query = $objDB->prepare("SELECT * FROM {$tableName}");
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
				
				echo "<br/>";
				echo "<a href='index.php'>Back to Table List</a>";
			}
			else{
				echo "No table selected.";
			}
			
		?>
	</body>
</html>