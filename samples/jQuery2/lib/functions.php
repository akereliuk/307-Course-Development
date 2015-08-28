<?php
function display_cart() {
  // show contents of the cart
  // cart is stored as a $_SESSION['cart'] variable (array)

  echo "<h2>";
  echo count($_SESSION['cart']);
  if (count($_SESSION['cart']) == 1)
	   echo " item ";
  else
	   echo " items ";
  echo "in your basket. ";
  if (count($_SESSION['cart']) > 0)
	  echo "<a href='basket_view.php'>View</a>";
  echo "</h2>";  
	
}

function show_categories () {
	// show all of the film category names with links to their browsing page
	global $db;
	
	$result = $db->query("SELECT name, category_id from category");

    if ($result) {
	  echo " &bull; ";
      $arrRow = $result->fetchAll(PDO::FETCH_ASSOC);
	  foreach($arrRow as $category){
		echo "<a href=\"javascript:filter_category('{$category['category_id']}', '{$category['name']}');\">{$category['name']}</a> &bull; ";
	  }
	}
}

function get_category_name_from_id($categoryID){
	global $db;
	
	$query = $db->prepare("SELECT name, category_id from category WHERE category_id = :category_id");
	$query->bindParam(":category_id", $categoryID);
	$query->execute();
	
	$row = $query->fetch();
	return $row['name'];
	
}

?>