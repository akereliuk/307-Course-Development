<?php

// This script will show a form with gallery sizing options, and then the images
// resized and/or cropped as desired.

// The images are manipulated in another script (resize.php). That script will take
// some parameters: name, size and option

// If the user changes a viewing option, they will need to submit the values to this
// script as a form.  This script will be "sticky" in that selected options will be
// preserved in the presented form

// First, check the data coming in and set the variables $requested_size and $requested_option

  if (isset($_REQUEST['size'])) {
     $requested_size = $_REQUEST['size'];
  } else {
    $requested_size = 100; // default value
  }
  
  // The list of allowed size options
  $sizes = array (100, 200, 400, 600);
  
  if (isset($_REQUEST['option'])) {
     $requested_option = $_REQUEST['option'];
  } else {
    $requested_option = "crop"; // default value
  }
  
  // The list of radio values for the options
  $options = array ("crop" => "Crop", "bestfit" => "Best Fit"); 
  
  
  // The folder that contains the uploaded images
  $dir = "../AssignedTask/uploads";
        
?>

<!DOCTYPE html>
<html>
	<head>
	    <meta charset="UTF-8">
		<title>Image Gallery with Resize</title>
		<link rel="stylesheet" href="main.css"/>
	</head>
	<body>
		<form action="" method="post" >
			Size:
			<select name='size'>
			<?php
		    foreach ($sizes as $size) {
		       echo "<option value='$size' ";
		       if ($size == $requested_size) echo " selected ";
		       echo " >$size</option>";
		    }
			?>
			</select>
			<div class='options'>
			<?php
		    foreach ($options as $value => $text) {
		       echo "<label> $text: <input type='radio' name='option' value='$value'";
		       if ($requested_option == $value) echo " checked ";
		       echo " /></label>"; 
		    }
			?>
			</div>
			<input type='submit' value='Resize'/>
		</form>
		<hr/>
		<div class='gallery'>
		<?php
		$picturesFolder = dir($dir);
		// Loop through the items in the directory (folder)
		while ($fileName = $picturesFolder->read()) { 
			// If the entry is an image file, create an img element
		    if (substr(mime_content_type("$dir/$fileName"),0,6) == "image/") {
		       if ($fileName != "error.png") 
		          echo "<img class='gallerythumbnail' src='resize.php?name=$fileName&size=$requested_size&option=$requested_option' />";
		    }
        }		    

		?>
		</div>
	</body>
</html>