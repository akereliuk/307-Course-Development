<?php

// index.php -- this page is protected.  In order for someone to see it, they must login with a username and 
// password

   session_start();	                                      
   
// We will use the auth session variable to indicate of the person has logged in

   if(@$_SESSION['auth'] != "yes")	                       
   {
      header("Location: Login_reg.php");
      exit();
   }
   
    include("lib/dbstuff.inc");	                            
	$query = $db->stmt_init();
    $query->prepare("SELECT * FROM Customer WHERE user_name=?");      
    $query->bind_param("s",$_SESSION['logname']);
	$query->execute();
	$result = $query->get_result();
	$cust_data = $result->fetch_all(MYSQLI_ASSOC);
?><!DOCTYPE html>
<html>
<head><title>Secret Page</title>
<link href="lib/style.css" rel="stylesheet"></head>
<body>
<p class='announce'>Let's Go Shopping.</p>
<pre>
<?php print_r($cust_data); ?>
<?php print_r($_SESSION); ?>
</pre>
</body></html>
