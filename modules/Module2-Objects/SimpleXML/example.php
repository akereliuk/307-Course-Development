<?php

	$objXML = simplexml_load_file("XML/albums.xml");
	
	echo $objXML->title;
	echo "<br/>";
	echo $objXML->artist;
	
	echo "<br/><br/>";
	
	foreach($objXML->tracklist->track as $track){
		echo $track . "<br/>";
	}
	
	echo "<br/>";
	
	echo $objXML->tracklist->track[5];
	
?>