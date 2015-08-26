<?php
	$set=$_REQUEST["set"];
	setcookie ('sitestyle', $set, time()+31536000);
	header("Location: settings.php");
?>