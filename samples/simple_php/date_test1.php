<html>
<body>
<?php

echo "<p style='text-align:center;'>".date("Y/m/d H:s")."</p>";

 $now = time(); // sets $now to contain the current timestamp
 echo "<p>Seconds since 1970 {$now}</p>";
 echo "<p>Current Local Time: ".date("D M Y h:i A e", $now)."</p>"; 
 date_default_timezone_set("America/Vancouver");
 echo "<p>Current Time: ".date("D M Y h:i A e", $now). "</p>";

 $course = "03-60-307 2013F";
  echo "<p>".strchr($course,"-")."</p>";
  
  $email = "president@whitehouse.gov";
  echo "<p>".strchr($email, ".")."</p>";
  echo "<p>".strrchr($email, ".")."</p>";
?>
</body>
</head>
