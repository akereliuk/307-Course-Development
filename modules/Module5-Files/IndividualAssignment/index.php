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
				$path_parts = pathinfo($filename);
				echo "<a href='imagedetails.php?image=" . $path_parts['filename'] . "&ext=" . $path_parts['extension'] . "'><img class='gallerythumbnail' src='" . $filename . "'/></a>";
			}
		?>
		</div>
	</body>
</html>