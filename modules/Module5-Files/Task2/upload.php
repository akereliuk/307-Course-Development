<!DOCTYPE html>
<html>
	<head>
	    <meta charset='UTF-8'>
		<title>File Uploading Task</title>
		<link rel="stylesheet" href="main.css"/>
	</head>
	<body>
<?php

// This script will upload the file in the form, and show the file using an img tag, or
// display error messages.

// Compute the target file name
// The basename of the user's file will be used, converted to lowercase and then any non
// alphabetic and numeric characters are replaced with an underscore.

$fileToUpload = preg_replace("/[^a-z0-9-.]/", "_", strtolower(basename($_FILES["fileToUpload"]["name"]))); 

$errors = FALSE;

if(isset($_POST['submit'])){
	// check if the file is an image
	if (substr(mime_content_type($_FILES["fileToUpload"]["tmp_name"]),0,6) != "image/") {
		$errors = TRUE;
		echo "<p class='error'>The uploaded file is not an image.</p>";
	}
		
	// Check if file already exists
	if (file_exists("uploads/$fileToUpload")) {
		echo "<p class='error'>The file $fileToUpload already exists.</p>";
		$errors = TRUE;
	}

	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		echo "<p class='error'>Sorry, your file is too large.</p>";
		$errors = TRUE;
	} 
	
	// Save if there were no errors
	if ($errors) {
		echo "<p class='error'>YOUR FILE IS NOT SAVED.</p>";
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "uploads/$fileToUpload")) 
			echo "<p class='success'>The file $fileToUpload has been uploaded.</p><p><img src='uploads/$fileToUpload'/></p>";
		else 
			echo "<p class='error'>Sorry, there was an error uploading your file.</p>";
	}
}
	
	echo "<p class='bottom'><a href='index.php'>Return to Gallery</a></p>";
?>
</body>
</html>