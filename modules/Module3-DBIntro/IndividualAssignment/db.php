<?php

function connectDB(){
	return new PDO('mysql:host=localhost;dbname=kereliua_307;charset=utf8', 'kereliua_307', 'hellokitty16');
}

?>