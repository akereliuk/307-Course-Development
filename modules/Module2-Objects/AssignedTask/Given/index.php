<!DOCTYPE html>
<html>
<head>
		<title>Testing SimpleXML</title>
		<link rel="stylesheet" type="text/css" href="CSS/xmlbook.css" media="screen" />
		<meta charset="UTF-8" />
</head>
<body>
<?php
include_once "funcs.php";
	
// selecting the play to view can be done through URL variables.
	
// Set a default value.
	
$playFileName = "othello";
	
if (isset($_REQUEST['play']) && strlen(trim($_REQUEST['play'])) > 5) {
  $playFileName = trim($_REQUEST['play']);	
}
$playURL = "http://307.myweb.cs.uwindsor.ca/XML/${playFileName}.xml";	
	

if ($objPlay = simplexml_load_file($playURL)) {

	// grab the Act and Scene from the url
	if(isset($_GET["act"]) && isset($_GET["scene"])){
		$currentAct = intval($_GET["act"]);
		$currentScene = intval($_GET["scene"]);
	}
	else{
		$currentAct = 0;
		$currentScene = 0;
	}	

			displayPlayTitle($objPlay);
			displayTableOfContentsLink($playFileName); // this function is to be done by the student
			displayActSelector($playFileName,$objPlay, $currentAct);
			displaySceneSelector($playFileName,$objPlay, $currentAct, $currentScene);
			displayPlayText($objPlay, $currentAct, $currentScene);
		?>
		<div id="scrolltotop" class="selectorbar">
			<a href="#top">Back to Top</a>
		</div>
<?php
} else  {
    echo "<p class='error'>XML file $playURL was not found.</p>"; 
}
?>
	</body>
</html>