<?php
	include_once "funcs.php";

	$strPlay = $_GET["play"];
?>

<html>
	<head>
		<title>Assigned Task - Table of Contents</title>
		<link rel="stylesheet" type="text/css" href="CSS/xmlbook.css" media="screen" />
	</head>
	<body>
		<?=displayTableOfContents($strPlay)?>
	</body>
</html>