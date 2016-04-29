<?php
$db = new PDO("mysql:host=localhost;dbname=DBNAME", "DBUSER","DBPASSWORD");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*

TABLE STRUCTURE
-------------------------------------------------------------------------------	

CREATE TABLE `users` (
  user_name varchar(20) NOT NULL,
  create_date DATETIME,
  password varchar(50) NOT NULL,
  first_name varchar(50) NOT NULL,
  last_name varchar(50) NOT NULL,
  street varchar(100),
  city varchar(100),
  prov char(2),
  postalcode char(7),
  phone varchar(50),
  email varchar(100) NOT NULL,
  PRIMARY KEY (user_name)
) ;

*/
?>

