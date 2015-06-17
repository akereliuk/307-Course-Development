<?php
	function displayPlayTitle($objPlay){
		return "<div id='titlebar'>" . $objPlay->TITLE . "</div>";
	}
	
	// this is to be written by the student
	// it will be a link to a table of contents for the current play
	function displayTableOfContentsLink($objPlay){
		return "<div id='tableofcontents' class='selectorbar'><a href='tableofcontents.php?play=" . $objPlay->XMLTITLE . " '>Table of Contents</a></div>";
	}
	
	// this is to be written by the student
	// it will display the table of contents on an external page, with links to all ACTS, SCENES, and their corresponding names
	function displayTableOfContents($strPlay){
		$objPlay = simplexml_load_file('XML/' . $strPlay);
		if(!$objPlay){
			return "Error loading XML file.";
		}
		else{
			$strReturn = "<h2>Table of Contents</h3>";
			$strReturn .= "<ul>";
			$actCounter = 0;
			foreach($objPlay->ACT as $act){
				$strReturn .= "<li><a href='index.php?act=" . $actCounter . "&scene=0'>" . $act->TITLE . "</a></li>";
				$strReturn .= "<ul>";
				$sceneCounter = 0;
				foreach($act->SCENE as $scene){
					$strReturn .= "<li><a href='index.php?act=" . $actCounter . "&scene=" . $sceneCounter . "'>" . $scene->TITLE . "</a></li>";
					$sceneCounter++;
				}
				$strReturn .= "</ul>";
				$actCounter++;
			}
			$strReturn .= "</ul>";
			return $strReturn;
		}
	}

	function displayActSelector($objPlay, $currentAct){
		// disable the prev/next act links if they do not exist
		$prevActLink = ($currentAct - 1 < 0) ? "" : "<a href='index.php?act=" . ($currentAct - 1) . "&scene=0'>Go to Previous Act</a> | ";
		$nextActLink = (!isset($objPlay->ACT[$currentAct+1])) ? "" : " | <a href='index.php?act=" . ($currentAct + 1) . "&scene=0'>Go to Next Act</a>";
		
		return "<div id='actselector' class='selectorbar'>" .
					$prevActLink . "<b>" . $objPlay->ACT[$currentAct]->TITLE . "</b>" . $nextActLink . "
			   </div>";
	}
	
	function displaySceneSelector($objPlay, $currentAct, $currentScene){
		// disable the prev/next scene links if they do not exist
		$prevSceneLink = ($currentScene - 1 < 0) ? "" : "<a href='index.php?act=" . $currentAct . "&scene=" . ($currentScene - 1) . "'>Go to Previous Scene</a> | ";
		
		// move to the next act if reached the end of the current act and wanting to progress to the next scene
		// if no more acts available, disable the next scene link
		if(!isset($objPlay->ACT[$currentAct]->SCENE[$currentScene+1]) && isset($objPlay->ACT[$currentAct+1])){
			$nextSceneLink = " | <a href='index.php?act=" . ($currentAct+1) . "&scene=0'>Go to Next Scene</a>";
		}
		else if(!isset($objPlay->ACT[$currentAct]->SCENE[$currentScene+1]) && !isset($objPlay->ACT[$currentAct+1])){
			$nextSceneLink = "";
		}
		else{
			$nextSceneLink = " | <a href='index.php?act=" . $currentAct . "&scene=" . ($currentScene + 1) . "'>Go to Next Scene</a>";
		}
		
		return "<div id='sceneselector' class='selectorbar'>" .
					$prevSceneLink . "<b>" . $objPlay->ACT[$currentAct]->SCENE[$currentScene]->TITLE . "</b>" . $nextSceneLink . "
				</div>";
	}
	
	function displayPlayText($objPlay, $currentAct, $currentScene){
		// loop through current scene of current act and output all relevant text
		$strReturn = "<div id='bookcontents'>";
		// StageDir element is a bit of a problem since it appears in random places in the scene.. how do we extract every StageDir element at the right spot?
		$strReturn .= "<br/><b>" . $objPlay->ACT[$currentAct]->SCENE[$currentScene]->STAGEDIR . "</b><br/>";
		foreach($objPlay->ACT[$currentAct]->SCENE[$currentScene]->SPEECH as $speech){
			$strReturn .= "<br/><b>" . $speech->SPEAKER . ":</b> ";
			foreach($speech->LINE as $line){
				$strReturn .= $line . "<br/>";
			}
		}
		$strReturn .= "</div>";
		return $strReturn;
	}
?>