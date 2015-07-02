<?php

function connectDB(){
	return new PDO('mysql:host=localhost;dbname=307online;charset=utf8', 'root', '');
}

?>