<?php
  // Logout
  // Destroy the session and the session variables associated.
  
  session_start();
  $_SESSION = array();
  session_destroy();  
  header("Location: index.php");
  exit;

?>