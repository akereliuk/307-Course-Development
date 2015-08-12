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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
	var table;
	$( document ).ready(function() {
		table = $('#filmlist').DataTable({
			"iDisplayLength": 20,
			"ajax": 'data.json',
			"columns": [
			{ "data": "title" },
			{ "data": "release_year" },
			{ "data": "length" },
			{ "data": "rental_rate" }
			]
		});
	});
	
	function filter_category(categoryID, categoryName){
		$.ajax({
				url: 'ajax.php',
				async: true,
				type: 'post',
				contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15",
				data: {
					categoryID: categoryID
				},
				success: function(data){
					$('#movielistheader').text('Showing ' + categoryName);
					$('#movielistbody').html(data);
					table.ajax.url('data.json').load();
				},
				error: function(textStatus, errorThrown){
					alert(textStatus);
				}
		});
	}
</script>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="../../DataTables/media/css/jquery.dataTables.css">
  
<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="../../DataTables/media/js/jquery.js"></script>
  
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="../../DataTables/media/js/jquery.dataTables.js"></script>
</head>
<body>
<h1 id='movielistheader'>Showing <?=get_category_name_from_id($_GET['category_id'])?></h1>
<?php display_cart(); ?>
<h3><?php show_categories(); ?></h3>

<table id='filmlist' class='filmlist'>
	<thead>
		<tr>
			<th>Title</th><th>Release Year</th><th>Length</th><th>Rental Rate</th><th> </th>
		</tr>
	</thead>
	<tbody id='movielistbody'>
		<?php
			global $db;
			$query = $db->prepare("select * from film_category JOIN film USING (film_id) JOIN category USING (category_id) WHERE category_id = :category_id ORDER BY release_year DESC, title");
			$query->bindParam(":category_id", $_GET['category_id']);
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
		?>
	</tbody>
</table>
</body>
</html>



