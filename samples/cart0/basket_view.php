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
<h1>Basket View</h1>
<h3><?php show_categories(0); ?></h3>
<table class='filmlist'>
<tr><th>Title</th><th> </th></tr>
<?php
foreach ($_SESSION['cart'] as $k => $v) {
		echo "<tr>";
	echo "<td>$v</td>";
	echo "<td class='cnt'>";
	echo "<a class='remove' href='basket_remove.php?film_id=$k'>Remove from Basket</a>";
	echo "</td>";
	echo "</tr>";

	
}
?>
</table>
</body>
</html>
 