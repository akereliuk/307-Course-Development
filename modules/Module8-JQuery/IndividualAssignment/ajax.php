<?php

	include ("lib/db.config");
	 
	if(isset($_POST['categoryID'])){
		setMovieCategory($_POST['categoryID']);
	}
	
	function setMovieCategory($categoryID){
		session_start();
		global $db;
		$query = $db->prepare("select * from film_category JOIN film USING (film_id) JOIN category USING (category_id) WHERE category_id = :category_id ORDER BY release_year DESC, title");
		$query->bindParam(":category_id", $categoryID);
		$query->execute();
		$films = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($films as $film) {
			echo "<tr>";
			echo "<td class='title'>{$film['title']}</td>";
			echo "<td class='cnt'>{$film['release_year']}</td>";
			echo "<td class='right'>{$film['length']}</td>";	
			echo "<td class='right'>$ {$film['rental_rate']}</td>";
			echo "<td class='cnt'>";
			if (isset($_SESSION['cart'][$film['film_id']])) {
				echo "<a class='remove' href='basket_remove.php?film_id={$film['film_id']}'>Remove from Basket</a>";
				
			} else {
				$title = urlencode($film['title']);
				echo "<a class='add' href='basket_add.php?film_id={$film['film_id']}&title=$title'>Add to Basket</a>";
				
			}
			echo "</td>";
			echo "</tr>";
		}
	}
	
?>