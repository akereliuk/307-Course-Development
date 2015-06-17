<?php
	include_once "funcs.php";
	
	// selecting the play to view can be done on a menu page before this
	$objPlay = simplexml_load_file('XML/othello.xml');
	
	// grab the Act and Scene from the url
	if(isset($_GET["act"]) && isset($_GET["scene"])){
		$currentAct = intval($_GET["act"]);
		$currentScene = intval($_GET["scene"]);
	}
	else{
		$currentAct = 0;
		$currentScene = 0;
	}	
?>

<html>
	<head>
		<title>Testing SimpleXML</title>
		<link rel="stylesheet" type="text/css" href="CSS/xmlbook.css" media="screen" />
	</head>
	<body>
		<?php
			echo displayPlayTitle($objPlay);
			echo displayTableOfContentsLink($objPlay); // this function is to be done by the student
			echo displayActSelector($objPlay, $currentAct);
			echo displaySceneSelector($objPlay, $currentAct, $currentScene);
			echo displayPlayText($objPlay, $currentAct, $currentScene);
		?>
		<div id="scrolltotop" class="selectorbar">
			<a href="#top">Back to Top</a>
		</div>
	</body>
</html>