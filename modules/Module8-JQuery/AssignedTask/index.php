<?php include_once "images.php"; ?>

<!DOCTYPE html>
<html>
	<head>
		<title>File Uploading</title>
		<?php include_once "stylesheet.php"; ?>
		<script type='text/javascript'>
			function likeImage(intImageID, intUserID){
				$.ajax({
						url: 'images.php',
						async: true,
						type: 'post',
						contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15",
						data: {
							action: 'likeImage',
							intImageID: intImageID,
							intUserID: intUserID
						},
						success(data) {
							$('#likesBar' + intImageID).html(data);
						},
						error: function(textStatus, errorThrown){
							alert(textStatus);
						}
				});
			}
			
			function unlikeImage(intImageID, intUserID){
				$.ajax({
						url: 'images.php',
						async: true,
						type: 'post',
						contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15",
						data: {
							action: 'unlikeImage',
							intImageID: intImageID,
							intUserID: intUserID
						},
						success(data) {
							$('#likesBar' + intImageID).html(data);
						},
						error: function(textStatus, errorThrown){
							alert(textStatus);
						}
				});
			}
		</script>
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
				echo "<table><tr>";
				foreach($arrImages as $key => $filename){
					$path_parts = pathinfo($filename);
					echo "<td><a href='imagedetails.php?image=" . $path_parts['filename'] . "&ext=" . $path_parts['extension'] . "'><img class='gallerythumbnail' src='uploads/" . $filename . "'/></a>";
					echo "<div id='likesBar" . $key . "'>" . ((isset($_SESSION['intUserID'])) ? getLikesBar($key, $_SESSION['intUserID']) : getGuestLikesBar($key)) . "</div>";
					$intCounter++;
				}
				if(!$intCounter){
					echo "<td><b>No images to display.</b></td>";
				}
				echo "</tr></table>";
			?>
			</div>
		</div>
	</body>
</html>