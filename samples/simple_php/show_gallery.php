<!DOCTYPE html>
<html>
<head>
<style>
div.big img {
	width: 500px;
	height: 500px;
	margin: 5px;
	float: left;
}
div.small {
	height: 505px;
	width: 280px;
	overflow: auto;
	float: left;
}
div.small img {
	width: 250px;
	height: 250px;
	margin: 5px;
}
</style>
</head>
<body>
<?php
$dir = '/home/steve/domains/steve.myweb.cs.uwindsor.ca/uploads';
$files = scandir($dir); // Read all the images into an array.
// fast forward over any files that start with .
$index = 0;
while ($files[$index]{0} == ".")
	$index++;
// $index is now referencing the first "real" file in the directory
// let's make that the large image
echo "<div class='big'>";
echo "<img src='square_image.php?filename={$files[$index]}&x=500' />";
echo "<div>";
// the rest of the images in the array will be shown 1/4 the size
echo "<div class='small'>";
for ($index = $index+1; $index < count($files) -1; $index++) {
    echo "<img src='square_image.php?filename={$files[$index]}&x=250' />";	
}
echo "</div>";
?>
</body>
</html>