<?php

	require_once('/usr/local/lib/php/jpgraph/src/jpgraph.php');
	require_once('/usr/local/lib/php/jpgraph/src/jpgraph_bar.php');

	$arrLineCount = array();
	
	$objPlay = simplexml_load_file('XML/othello.xml');
	
	foreach($objPlay->ACT as $act){
		foreach($act->SCENE as $scene){
			foreach($scene->SPEECH as $speech){
				$speaker = strval($speech->SPEAKER);
				if(!array_key_exists($speaker, $arrLineCount)){
					$arrLineCount[$speaker] = 0;
				}
				foreach($speech->LINE as $line){
					$arrLineCount[$speaker]++;
				}
			}
		}
	}
	
	$datax = array_keys($arrLineCount); // characters in the play
	$datay = array_values($arrLineCount); // number of lines spoken
	
	$graph = new Graph(1300,600); // create a graph object, which is the canvas that will house our barplot
	$graph->SetScale('textint'); // the first part of the string represents the x-axis scale, and the second part represents the y-axis scale
											// in this case, we have x-axis with text (string) data and y-axis with integer data
	
	$graph->xaxis->SetTickLabels($datax); // set tick labels with x-axis data
	$graph->xaxis->SetLabelAngle(45); // rotate x-axis labels by 45 degrees
	$graph->xaxis->SetTitleMargin(50);
	$graph->yaxis->SetTitleMargin(30);
	$bplot = new BarPlot($datay); // create a barplot object with the y-axis data
	
	$graph->Add($bplot); // map the barplot to our graph canvas
	
	$graph->title->Set($objPlay->TITLE . " - Number of Lines Spoken By Character"); // set your graph title
	$graph->xaxis->title->Set("Character"); // set your x-axis title
	$graph->yaxis->title->Set("Number of Lines"); // set your y-axis title
	
	$graph->Stroke(); // write the graph to this php file
?>