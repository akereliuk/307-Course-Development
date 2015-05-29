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

$result = $db->query("SELECT count(title), name, category_id from film JOIN film_category USING (film_id) JOIN category USING (category_id) GROUP BY name");

if ($result) {

  while ($category = $result->fetch_assoc()) {

   echo "<div class='category'> {$category['name']}<a href='browse.php?category_id={$category['category_id']}'>Browse {$category['count(title)']}</a></div>";

  }
}
?>
</div>
</body>
</html>