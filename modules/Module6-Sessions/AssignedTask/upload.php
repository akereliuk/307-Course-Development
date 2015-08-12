<?php include_once "images.php"; ?>

<html>
	<head>
		<title>File Uploading</title>
		<link rel="stylesheet" href="main.css"/>
	</head>
	<body>
		<?php include_once "navigation.php"; ?>
		<div class='content'>
			<?php
				$fileToUpload = "uploads/" . basename($_FILES["fileToUpload"]["name"]);
				$imageFileType = pathinfo($fileToUpload,PATHINFO_EXTENSION);
				$uploadOK = 0;
				if(isset($_POST['submit'])){
					// check if the file is an image
					$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					if($check !== false){
						$uploadOK = 1;
						echo "File is an image - " . $check["mime"] . ".<br/>";
					}
					else{
						$uploadOK = 0;
						echo "File is not an image.<br/>";
					}
					
					// Check if file already exists
					if (file_exists($fileToUpload)) {
						echo "Sorry, file already exists.<br/>";
						$uploadOK = 0;
					}
					
					// Check file size
					if ($_FILES["fileToUpload"]["size"] > 500000) {
						echo "Sorry, your file is too large.<br/>";
						$uploadOK = 0;
					} 
				}
				
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOK == 0) {
					echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
					if(uploadImage(array('intUserID' => $_SESSION['intUserID'], 'strImageName' => basename( $_FILES["fileToUpload"]["name"]), 'dtmCreatedOn' => date('Y-m-d H:i:s'), 'strCreatedBy' => 'system'))){
						$uploadOK = 1;
					}
					else{
						echo "Error inserting image to database.";
						$uploadOK = 0;
					}
					if($uploadOK == 1){
						if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $fileToUpload)) {
							echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br/><img src='uploads/" . $_FILES["fileToUpload"]["name"] . "'/><br/>";
						} else {
							echo "Sorry, there was an error uploading your file.<br/>";
						}
					}
				}
				
				echo "<a href='index.php'>Return to Gallery</a>";
			?>
		</div>
	</body>
</html>