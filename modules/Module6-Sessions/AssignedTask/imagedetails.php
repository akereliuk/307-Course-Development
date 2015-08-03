<?php include_once "images.php"; ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Image Details</title>
		<link rel="stylesheet" href="main.css"/>
	</head>
	<body>
		<?php include_once "navigation.php"; ?>
		<div class='content'>
			<?php
				$arrImageDetails = getDetailsFromImageName($_GET['image'] . '.' . $_GET['ext']);
			?>
			<h3><?=$_GET['image']?> - Created By <?=$arrImageDetails['strUserID']?> on <?=$arrImageDetails['dtmCreatedOn']?></h3>
			<form action='#' method='post'>
				<select name='resize'>
					<option>100</option>
					<option>200</option>
					<option>400</option>
					<option>600</option>
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
		</div>
	</body>
</html>