<!DOCTYPE HTML>
<html>
<head>
<title>Calculate.php Script</title>
</head>
<body>
<?php
function average3($a, $b, $c) {
	return ($a+$b+$c)/3;
}

if (isset($_POST['v1'], $_POST['v2'],$_POST['v3']) && 
    is_numeric($_POST['v1']) && is_numeric($_POST['v2']) && is_numeric($_POST['v3'])) {
		
	$min = min($_POST['v1'],$_POST['v2'],$_POST['v3']);
	
	$avg = average3($_POST['v1'],$_POST['v2'],$_POST['v3']);
	
	echo "<p>The values you entered were: ";
	echo number_format($_POST['v1'],2);
	echo " ";
	echo number_format($_POST['v2'],2);
	echo " ";
	echo number_format($_POST['v3'],2);
	echo "</p>";
	echo "<p>The minumum value is ";
	echo number_format($min,2);
	echo " and the average value is ";
	echo number_format($avg,2);
	echo "</p>";
	
} else {
    echo "<p class='error'>The submitted form data is not valid. Please go back and fix the values and try again.</p>";
}
?>
</body></html>