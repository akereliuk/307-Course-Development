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
 
 
?><!DOCTYPE html>
<html>
<head><title>Shopping Cart Example</title>
<link rel="stylesheet" href="lib/style.css" />
</head>
<body>
<h1>Categories</h1>
<?php display_cart(); ?>
<div class="container">
<?php

// get a list of categories with movie counts in each group

$result = $db->query("SELECT name,count(title) AS count, category_id from film join film_category USING (film_id) join category using (category_id) GROUP BY name");

if ($result) {
   $arrRow = $result->fetchAll(PDO::FETCH_ASSOC);
	foreach($arrRow as $category){
		echo "<div class='category'>{$category['name']}<a href='browse.php?category_id={$category['category_id']}'>Browse {$category['count']} titles</a></div>";
	}   
	
}

?>
</div>
</body>
</html>