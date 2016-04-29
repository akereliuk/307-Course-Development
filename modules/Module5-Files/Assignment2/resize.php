<?php
// This script will resize an image based on inputs from the form
// name is the name of the file in the directory
// size is the size of the image to be produced (it will be square)
// option is either crop or best fit, and determines now we are going to resize the image


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
$dir = "../AssignedTask/uploads";

try {

  // If the file does not exist, or is not an image, an exeception will be thrown
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
  
  header("Content-Type: image/png");
  header('Pragma: public');
  header('Cache-Control: max-age=86400');
  header('Expires: '. gmdate('D, d M Y H:i:s \G\M\T', time() + 86400));
  header('Content-Type: image/png');

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
