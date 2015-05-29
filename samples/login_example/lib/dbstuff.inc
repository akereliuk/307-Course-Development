<?php
$db = @new mysqli("localhost", "steve_customers", "XBn90*", "steve_customers");

if ($db->connect_errno) {
   printf("Connect Error %d: %s", $db->connect_errno, $db->connect_error);
   exit(0);
}

/*

TABLE STRUCTURE
-------------------------------------------------------------------------------

CREATE TABLE `Customer` (
  `user_name` VARCHAR(20) NOT NULL,
  `create_date` DATE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(50),
  `first_name` VARCHAR(40),
  `street` VARCHAR(50),
  `city` VARCHAR(50),
  `prov` CHAR(2),
  `postalcode` CHAR(7),
  `email` VARCHAR(50),
  `phone` CHAR(15),
  PRIMARY KEY(user_name) 
);

*/
?>