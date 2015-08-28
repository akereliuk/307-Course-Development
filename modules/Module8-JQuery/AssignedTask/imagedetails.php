<?php include_once "images.php"; ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Image Details</title>
		<?php include_once "stylesheet.php"; ?>
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
					<option <?=((isset($_POST['resize']) && $_POST['resize'] == '100') ? 'selected' : '')?>>100</option>
					<option <?=((isset($_POST['resize']) && $_POST['resize'] == '200') ? 'selected' : '')?>>200</option>
					<option <?=((isset($_POST['resize']) && $_POST['resize'] == '400') ? 'selected' : '')?>>400</option>
					<option <?=((isset($_POST['resize']) && $_POST['resize'] == '600') ? 'selected' : '')?>>600</option>
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