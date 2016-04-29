<?php
	function displayPlayTitle($objPlay){
		echo "<div id='titlebar'>" . $objPlay->TITLE . "</div>";
	}
	
	// this is to be written by the student
	// it will be a link to a table of contents for the current play
	function displayTableOfContentsLink($strPlay){
		echo "<div id='tableofcontents' class='selectorbar'><a href='tableofcontents.php?play={$strPlay}'>Table of Contents</a></div>";
	}
	
	// **************************************************************************************
	// this is to be written by the student
	// it will display the table of contents on an external page, with links to all ACTS, SCENES, and their corresponding names
	function displayTableOfContents($strPlay){
		
	}
	// ************************************************************************************

	function displayActSelector($strPlay,$objPlay, $currentAct){
		// disable the prev act links if they do not exist
		if($currentAct - 1 < 0){
			$prevActLink = "";
		}
		else{
			$prevActLink = "<a href='index.php?play={$strPlay}&act=" . ($currentAct - 1) . "&scene=0'>Go to Previous Act</a> | ";
		}
		
		// disable the next act links if they do not exist
		if(!isset($objPlay->ACT[$currentAct+1])){
			$nextActLink = ""; 
		}
		else{
			$nextActLink = " | <a href='index.php?play={$strPlay}&act=" . ($currentAct + 1) . "&scene=0'>Go to Next Act</a>";
		}
		
		// output the act selector bar to html
		echo "<div id='actselector' class='selectorbar'>" .
					$prevActLink . "<b>" . $objPlay->ACT[$currentAct]->TITLE . "</b>" . $nextActLink . "
			   </div>";
	}
	
	function displaySceneSelector($strPlay,$objPlay, $currentAct, $currentScene){
		// disable the previous scene link if there is no previous scene
		if($currentScene - 1 < 0){
			$prevSceneLink = "";
		}
		else{
			$prevSceneLink = "<a href='index.php?play={$strPlay}&act=" . $currentAct . "&scene=" . ($currentScene - 1) . "'>Go to Previous Scene</a> | ";
		}
		
		// move to the next act if reached the end of the current act and wanting to progress to the next scene
		// if no more acts available, disable the next scene link
		if(!isset($objPlay->ACT[$currentAct]->SCENE[$currentScene+1]) && isset($objPlay->ACT[$currentAct+1])){
			$nextSceneLink = " | <a href='index.php?play={$strPlay}&act=" . ($currentAct+1) . "&scene=0'>Go to Next Scene</a>";
		}
		else if(!isset($objPlay->ACT[$currentAct]->SCENE[$currentScene+1]) && !isset($objPlay->ACT[$currentAct+1])){
			$nextSceneLink = "";
		}
		else{
			$nextSceneLink = " | <a href='index.php?play={$strPlay}&act=" . $currentAct . "&scene=" . ($currentScene + 1) . "'>Go to Next Scene</a>";
		}
		
		// output the scene selector bar to html
		echo "<div id='sceneselector' class='selectorbar'>" .
					$prevSceneLink . "<b>" . $objPlay->ACT[$currentAct]->SCENE[$currentScene]->TITLE . "</b>" . $nextSceneLink . "
				</div>";
	}
	
	function displayPlayText($objPlay, $currentAct, $currentScene){
		// loop through current scene of current act and output all relevant text
		echo "<div id='bookcontents'>";

		// loop through all of the children, in order, of the current scene.
		// the childrean should all be a STAGEDIR or a SPEECH element
		foreach ($objPlay->ACT[$currentAct]->SCENE[$currentScene] as $key => $text_item) {
		  switch ($key) {
			case 'STAGEDIR':
			   echo "<br/><b>$text_item</b><br/>";
			   break;
			case 'SPEECH':
			  echo "<br/><b>{$text_item->SPEAKER}:</b> ";
			  foreach($text_item->LINE as $line){
				echo $line . "<br/>";
		      }
			  break;
			case 'TITLE': // do nothing — we are showing the title in the header
			  break;
			default:
			  echo "$text_item<br />";
			  break;
		  }
		}
		echo"</div>";
	}
?>