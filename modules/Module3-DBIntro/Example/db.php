<?php

function connectDB(){
	return new PDO('mysql:host=localhost;dbname=307;charset=utf8', 'root', '');
}

?>