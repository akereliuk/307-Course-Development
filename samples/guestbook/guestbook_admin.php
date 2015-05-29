<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="guestbook/style.css" />
</head>
<body>
<h1>Guestbook Administrator Interface</h1>
<?php
// GUESTBOOK BACKEND

require_once("guestbook/db.config");

$result = $db->query("SELECT * FROM guestbook ORDER BY comment_date DESC");

if ($result) {
	echo "<form action='guestbook_delete_multi2.php' method='post' />";
    echo "<table class='guestbook'>";
	echo "<tr><th>Name</th><th>City</th><th>Comments</th><th>Visit Date</th><th><input type='submit' value='Delete' /></th></tr>";
    while ($comment = $result->fetch_assoc()) {
       echo "<tr>";
       echo "<td>{$comment['visitor_name']}</td><td>{$comment['visitor_city']}</td>";
       echo "<td>{$comment['comments']}</td>";
       echo "<td style='text-align: center;'>{$comment['visit_date']}</td>";
	   echo "<td style='text-align: center;'>";
	   echo "<input type='checkbox' name='id[{$comment['id']}]'  />";
	   echo "</td>";
       echo "</tr>";
    }
    echo "</table></form>";

}

$result->free();
$db->close();

?>
</body></html>