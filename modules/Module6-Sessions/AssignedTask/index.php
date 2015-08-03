<?php include_once "images.php"; ?>

<!DOCTYPE html>
<html>
	<head>
		<title>File Uploading</title>
		<link rel="stylesheet" href="main.css"/>
	</head>
	<body>
		<?php include_once "navigation.php"; ?>
		<div class='content'>
			<h3>Image Gallery</h3>
			<hr/>
			<?php
				if(isset($_SESSION['userID'])){
			?>
				<form action="upload.php" method="post" enctype="multipart/form-data">
					Select image to upload:
					<input type="file" name="fileToUpload" id="fileToUpload"/>
					<input type="submit" value="Upload Image" name="submit"/>
				</form>
			<?php } else{ ?>
				You must log in to upload an image.
			<?php } ?>
			<hr/>
			<div class='gallery'>
			<?php
				$arrImages = retrieveImages();
				$intCounter = 0;
				foreach($arrImages as $key => $filename){
					$path_parts = pathinfo($filename);
					echo "<a href='imagedetails.php?image=" . $path_parts['filename'] . "&ext=" . $path_parts['extension'] . "'><img class='gallerythumbnail' src='uploads/" . $filename . "'/></a>";
					$intCounter++;
				}
				if(!$intCounter){
					echo "<b>No images to display.</b>";
				}
			?>
			</div>
		</div>
	</body>
</html>