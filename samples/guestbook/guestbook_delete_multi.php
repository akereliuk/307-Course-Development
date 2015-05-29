<?php
// GUESTBOOK BACKEND
require_once("guestbook/db.config");

if (count($_POST['id']) > 0) {
	$q = $db->real_escape_string( implode(",",array_keys($_POST['id'])));
	$result = $db->query("DELETE FROM guestbook WHERE id IN ($q)");
	if ($result && $db->affected_rows > 0) {
		header("Location: ./guestbook_admin_multi.php?msg=".urlencode("<p class='thanks'>{$db->affected_rows} row(s) have been deleted.</p>"));
		exit(0);
    } else {
		header("Location: ./guestbook_admin_multi.php?msg=".urlencode("<p class='error'>Delete failed.</p>"));
		exit(0);
	}
} else {
	header("Location: ./guestbook_admin_multi.php?msg=".urlencode("<p class='error'>ID was not provided.</p>"));
	exit(0);
}
header("Location: ./guestbook_admin_multi.php");
?>
