<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="guestbook/style.css" />
</head>
<body>
<h1>Guestbook Delete Entry</h1>
<?php
// GUESTBOOK BACKEND
require_once("guestbook/db.config");

if ($_REQUEST['id'] > 0) {
	$query = $db->stmt_init();
	$query->prepare("DELETE FROM guestbook WHERE id = ?");
	$query->bind_param("i",$_REQUEST['id']);
	$result=$query->execute();
	if ($result && $db->affected_rows > 0) {
		echo "<p class='thanks'>Entry has been deleted.</p>";
    } else {
		echo "<p class='error'>Delete failed.</p>";
	}
} else {
	echo "<p class='error'>ID was not provided.</p>";
}
echo "<p><a href='guestbook_admin.php'>Return to List</a></p>";

$db->close();
?>
</body></html>

