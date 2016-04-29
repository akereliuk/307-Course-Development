<?php
// This script will resize an image based on inputs from the form
// name is the name of the file in the directory
// size is the size of the image to be produced (it will be square)
// option is either crop or best fit, and determines now we are going to resize the image

// If the user is not logged in, a watermark will be placed over the image
session_start();

// First check the options and if they are not provided, set them to default values.

if (isset($_REQUEST['size'])) {
     $requested_size = $_REQUEST['size'];
} else {
    $requested_size = 100; // default value
}

if (isset($_REQUEST['option'])) {
     $requested_option = $_REQUEST['option'];
} else {
    $requested_option = "crop"; // default value
}

// The location of the images  
$dir = "uploads";

try {

  // If the file does not exist, or is not an image, an exception will be thrown
  // and a generic error image will be returned
  
  $im = new Imagick("$dir/".basename($_REQUEST['name']));
  switch ($_REQUEST['option']) {
     case 'crop':
        $im->cropThumbnailImage($requested_size, $requested_size);
        break;
     default:
        $im->thumbnailImage($requested_size,$requested_size, TRUE, TRUE);
        break;
  }
  
  // Apply the watermark if the user is not logged in
  // The watermark image that I am using is 100 x 100 pixels wide.  
  // It will be centered in the $im object that will be sent to the user
  if (!isset($_SESSION['auth'])) {
	  $watermark = new Imagick("watermark.png");
	  $im->compositeImage($watermark, imagick::COMPOSITE_OVER,round(($im->getImageWidth()-100)/2),round(($im->getImageHeight()-100)/2));
  }
  
  header("Content-Type: image/png");

  $im->setFormat('png');
  echo $im;
 
} catch(Exception $e) {

  // Copy out a standard error image (error.png)
  $im = new Imagick("$dir/error.png");
  $im->thumbnailImage($requested_size,$requested_size);
  
  header("Content-Type: image/png");
  echo $im;

}

  
  
?>
