<!DOCTYPE html>
<html>
	<head>
		<title>Image Details</title>
		<link rel="stylesheet" href="main.css"/>
	</head>
	<body>
		<a href='index.php'>Return</a>
		<h3><?=$_GET['image']?></h3>
		<form action='#' method='post'>
			<select name='resize'>
				<option>100</option>
				<option>200</option>
				<option>400</option>
				<option>800</option>
			</select>
			<input type='submit' value='Resize'/>
		</form>
		<?php
			$pathName = 'uploads/' . $_GET['image'] . '.' . $_GET['ext'];
			if(isset($_POST['resize'])){
				$resizeAmount = $_POST['resize'];
			}
			else{
				$resizeAmount = '';
			}
			echo "<img src='" . $pathName . "' height='" . $resizeAmount . "' width='" . $resizeAmount . "'/>";
		?>
	</body>
</html>