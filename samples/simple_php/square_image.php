<?php
$dir = '/home/steve/domains/steve.myweb.cs.uwindsor.ca/uploads';
try {
	$i = new Imagick("$dir/{$_REQUEST['filename']}");
	$i->cropThumbnailImage($_REQUEST['x'],$_REQUEST['x']);
} 
catch (Exception $e) {
	$i = new Imagick();
    $i->newImage(50,50, new ImagickPixel("black"));
}
$i->setImageFormat("png");
header("Content-Type: image/png\n");
header("Content-Disposition: inline\n");
header("Content-Length: ".$i->getImageLength()."\n");
echo $i;
?>
