<?php
	require_once ('../../jpgraph/src/jpgraph.php');
	require_once ('../../jpgraph/src/jpgraph_bar.php');

	$datax = array("January", "February", "March", "April", "May", "June"); // x-axis data
	$datay = array(12,8,19,3,10,5); // y-axis data
	
	$graph = new Graph(400,300); // create a graph object, which is the canvas that will house our barplot
	$graph->SetScale('textint'); // the first part of the string represents the x-axis scale, and the second part represents the y-axis scale
											// in this case, we have x-axis with text (string) data and y-axis with integer data
	
	$graph->xaxis->SetTickLabels($datax); // set tick labels with x-axis data
	$bplot = new BarPlot($datay); // create a barplot object with the y-axis data
	
	$graph->Add($bplot); // map the barplot to our graph canvas
	
	$graph->title->Set("New Employees By Month"); // set your graph title
	$graph->xaxis->title->Set("Month"); // set your x-axis title
	$graph->yaxis->title->Set("Employees"); // set your y-axis title
	
	$graph->Stroke(); // write the graph to this php file
?>