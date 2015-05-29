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
?><!DOCTYPE html>
<html>
<head><title>Secret Page</title>
<link href="lib/style.css" rel="stylesheet"></head>
<body>
<p class='announce'>The User ID, <?php echo $_SESSION['logname']; ?>, has 
            successfully logged in</p>
</body></html>
