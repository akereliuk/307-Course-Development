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
			"ajax": 'ajax.php?categoryID=<?=$_GET['category_id']?>',
			"columns": [
			{ "data": "title" },
			{ "data": "release_year" },
			{ "data": "length" },
			{ "data": "rental_rate" }
			]
		});
	});
	
	function filter_category(categoryID, categoryName){
		$('#movielistheader').text('Showing ' + categoryName);
		table.ajax.url('ajax.php?categoryID=' + categoryID).load();
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
	</tbody>
</table>
</body>
</html>



