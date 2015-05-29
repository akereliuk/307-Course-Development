<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="guestbook/style.css" />
</head>
<body>
<?php

// GUESTBOOK SAMPLE - March 4, 2015

// Database information is stored in an external file, which will open the database, 
//       and set the $db global variable

require_once("guestbook/db.config");

$show_form = TRUE;

if (isset($_POST['send'])) {

   // A FORM HAS BEEN SUBMITTED, CHECK THE DATA AND SAVE TO THE DATBASE

   $visitor_name = strip_tags(trim($_POST['visitor_name']));
   $visitor_city = strip_tags(trim($_POST['visitor_city']));
   $comments = strip_tags(trim($_POST['comments']));
   $visit_date = strip_tags(trim($_POST['visit_date']));
   $nickname = trim($_POST['nickname']);
   $token = ($_POST['token']);
      
   if (strlen($nickname) == 0 && strlen($visitor_name) > 2 && strlen($visitor_city) > 5 && strlen($comments) > 10) {
       // Save the data
	   $query =  $db->stmt_init();
       if (isset($visit_date)) {
         $query->prepare("INSERT INTO `guestbook` (`visitor_name`,`visitor_city`,`comments`,`visit_date`,`comment_date`, `token`) VALUES (?,?,?,?, NOW(), ?)");
		 $query->bind_param("sssss",$visitor_name,$visitor_city,$comments,$visit_date,$token);
       } else {
         $query->prepare("INSERT INTO `guestbook` (`visitor_name`,`visitor_city`,`comments`,`comment_date`, `token`) VALUES (?,?,?,NOW(),?')");
 		 $query->bind_param("sssss",$visitor_name,$visitor_city,$comments,$token);
       }

       $result = $query->execute();
       if ($db->errno) 
          echo "<p class='error'>".$db->error."</p>";
       else {
          $show_form = FALSE;
          echo "<p class='thanks'>Thank you for your comments $visitor_name</p>";
       }

    } else {
       echo "<p class='error'>You must enter your name, city and comments.</p>";
    } 
} 

// SHOW THE FORM (UNLESS A NEW FORM WAS JUST SAVED)

if ($show_form) { 
?>
<p>Please share your thoughts for our guest book.</p>
<form class='guestbook' action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
<table id='form-table'>
<tr><td>Your Name</td><td><input type="text" name="visitor_name" /></td></tr>
<tr><td>Your Hometown</td><td><input type="text" name="visitor_city" /></td></tr>
<tr><td>Your Thoughts</td><td><textarea name="comments"></textarea></td></tr>
<tr><td>Date Visited (optional)</td><td><input type="text" name="visit_date" placeholder="YYYY-MM-DD" /></td></tr>
<tr class='noshow'><td>Nickname (required)</td><td><input type="text" name="nickname" /></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" name="send" value="Save Comments" /></td></tr>
</table>
<input type="hidden" name="token" value="<?php echo uniqid(); ?>" />
</form>
<?php
}

echo "<p>What some other visitors have said in the past.</p>";

// DISPLAY THE EXISTING GUESTBOOK

$result = $db->query("SELECT * FROM guestbook ORDER BY comment_date DESC");

if ($result) {
    echo "<div class='guestbook'>";
    while ($comment = $result->fetch_assoc()) {
       echo "<div class='comment'>";
       echo "<div class='visitor'>{$comment['visitor_name']}, {$comment['visitor_city']}</div>";
       echo "<span class='comment'>{$comment['comments']}</span>";
       if ($comment['visit_date'] != '0000-00-00')
          echo "<div class='visit-date'>Visited: {$comment['visit_date']}</div>";
       echo "</div>";
    }
    echo "<br clear='all' /></div>";

}

$result->free();
$db->close();

?>
</body></html>