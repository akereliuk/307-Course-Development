<?php

 // Shopping Cart Examples -- Using Session Variables for Storage
 // 60-307
 
 // Start the session with 3 hour timeout
 
 ini_set('session.gc_maxlifetime', 3*60*60);
 
 session_set_cookie_params(3*60*60);
 
 session_start();
 
 include ("lib/db.config");
 include ("lib/functions.php");
 
 if (!isset($_SESSION['cart']))
	 $_SESSION['cart'] = array();
 
 
 // Get all of the films for the given category ID

 $query = $db->stmt_init();
 $query->prepare("select * from film_category JOIN film USING (film_id) JOIN category USING (category_id) WHERE category_id = ?");
 $query->bind_param("i", $_REQUEST['category_id']);
 $query->execute();
 $result = $query->get_result();
 $films =  $result->fetch_all(MYSQLI_ASSOC);

// store in $films



?><!DOCTYPE html>
<html>
<head><title>Shopping Cart Example</title>
<link rel="stylesheet" href="lib/style.css" />
</head>
<body>
<h1>Browsing <?php echo $films[0]['name']; ?></h1>
<?php display_cart(); ?>
<h3><?php show_categories($_REQUEST['category_id']); ?></h3>

<table class='filmlist'>
<tr>
<th>Title</th><th>Release Year</th><th>Length</th><th>Rental Rate</th><th> </th>
</tr>
<?php
foreach ($films as $film) {
	echo "<tr>";
	echo "<td>{$film['title']}</td>";
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

?>
</table>
</body>
</html>



