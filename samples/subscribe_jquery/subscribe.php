<?php

$db = @new mysqli("localhost", "steve_jqvqs", "307jqueryrocks", "steve_jqvqs");

if ($db->connect_errno) {
   echo $db->connect_errno;
   exit(0);
}

/* insert email address into database */

$query =  $db->stmt_init();
if (isset($_POST['userEMail'])) {
         $query->prepare("INSERT INTO `registeredemail` (`address`) VALUES (?)");
		 $query->bind_param("s",$_POST['userEMail']);
		 $result = $query->execute();
         if ($db->errno) {
			 echo $db->errno;
		 } else {
			 echo 1;
		 }
} else {
	echo 0;
}
?>