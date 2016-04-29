<?php
require_once("../../jpgraph/src/jpgraph.php");
require_once("../../jpgraph/src/jpgraph_bar.php");

		    if( ! $xml = simplexml_load_file("http://307.myweb.cs.uwindsor.ca/XML/othello.xml") ) 
    { 
        echo 'unable to load XML file'; 
    } 
    else 
    { 
		$allLines = array();	//This holds all the characters names and lines.
		$numLines = array();	//This holds all the characters that get to speak and the number of times they do.
		$Names = array(); 		//This holds the top 5 names of the most talkative characters
		$Lines = array(); 		//This holds the top 5 amount of lines spoken by the most talkative characters
		$i=0;					//I use $i instead of array_push because its twice as fast.
		foreach( $xml as $ACT )  	//This seperates the acts and iterates through them.
		{ 
			foreach( $ACT as $SCENE ) 	//This seperates the scenes and iterates through them.
			{ 	
				foreach( $SCENE as $LINE ) 	//This seperates the lines and iterates through them.
				{ 
					if (!empty($LINE->SPEAKER)){ //This makes sure this particular index isnt empty
						$allLines[$i] = (string)$LINE->SPEAKER;	//Stores an enourmous array of all lines ever spoken
						$i++;	//Makes sure lines dont overwrite eachother
					}
				}
			}
		}
		$numLines = array_count_values($allLines);	//This automatic php function counts the amount of times someones name occurs,
													//Then makes an array consisting of the number of times a name occured.
		arsort($numLines);							//asort then places the order of the array from most lines to least lines
		$numLines = array_slice($numLines,0,5,true);//Slice then cuts the array to the top 5 speakers
		foreach( $numLines as $N => $L ) 			//This foreach loop simply splits the double array into two single arrays readable by jpgraph
		{ 
			array_push($Names,$N);
			array_push($Lines,$L);
		}
		
		$graph = new Graph(600,400); 				//Sets box size
		$graph->SetScale('textlin');				//Makes sure layout is correct
		$graph->xaxis->SetTickLabels($Names);		//Sets X axis names
		$graph->SetShadow();
		$graph->SetMargin(40,30,20,40);				//Adjusts margins arount titles and sides
		$bplot = new BarPlot($Lines);				//Adds the data to the graph which has already been labeled
		$bplot->SetFillColor('orange');
		$graph->Add($bplot);
		$graph->title->Set('The Tragedy of Othello - Number of Lines Spoken Per Character');
		$graph->xaxis->title->Set('Character');	
		$graph->yaxis->title->Set('Number of Lines');
		$graph->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->Stroke();							//Releases the completted graph as a png to be returned.
	}