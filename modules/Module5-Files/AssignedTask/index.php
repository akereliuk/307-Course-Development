<!DOCTYPE html>
<html>
	<head>
		<title>File Uploading</title>
		<link rel="stylesheet" href="main.css"/>
	</head>
	<body>
		<form action="upload.php" method="post" enctype="multipart/form-data">
			Select image to upload:
			<input type="file" name="fileToUpload" id="fileToUpload"/>
			<input type="submit" value="Upload Image" name="submit"/>
		</form>
		<hr/>
		<div class='gallery'>
		<?php
			foreach(glob("uploads/*") as $filename){
				echo "<img class='gallerythumbnail' src='" . $filename . "'/>";
			}
		?>
		</div>
	</body>
</html>