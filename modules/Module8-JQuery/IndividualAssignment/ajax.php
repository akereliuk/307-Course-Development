<?php

	include ("lib/db.config");
	 
	if(isset($_GET['categoryID'])){
		setMovieCategory($_GET['categoryID']);
	}
	
	function setMovieCategory($categoryID){
		session_start();
		global $db;
		$query = $db->prepare("select * from film_category JOIN film USING (film_id) JOIN category USING (category_id) WHERE category_id = :category_id ORDER BY release_year DESC, title");
		$query->bindParam(":category_id", $categoryID);
		$query->execute();
		$films = $query->fetchAll(PDO::FETCH_ASSOC);
		$arrFilms = array();
		$arrFilms['data'] = $films;
		echo json_encode($arrFilms);
	}
	
?>