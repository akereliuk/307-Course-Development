<!DOCTYPE html>
<html>
	<head>
	    <meta charset='UTF-8'>
		<title>File Uploading Task</title>
		<link rel="stylesheet" href="main.css"/>
	</head>
	<body>
		<form class="upload" action="upload.php" method="post" enctype="multipart/form-data">
			Select image to upload:
			<input type="file" name="fileToUpload" id="fileToUpload"/>
			<input type="submit" value="Upload Image" name="submit"/>
		</form>
		<hr/>
		<div class='gallery'>
		<?php
		    // Create a Directory object from the uploads folder
		    $picturesFolder = dir("uploads");
		    // Loop through the items in the directory (folder)
		    while ($fileName = $picturesFolder->read()) { 
		       // If the entry is an image file, create an img element
		       if (substr(mime_content_type("uploads/$fileName"),0,6) == "image/") {
				  echo "<img class='gallerythumbnail' src='uploads/$fileName' />";
               }		    
		    }
		?>
		</div>
	</body>
</html>