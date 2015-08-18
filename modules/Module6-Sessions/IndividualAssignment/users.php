<?php

include_once "Database.class";

function user_exists($strUsername) {
	$objDB = new Database();
	$query = $objDB->prepare("SELECT COUNT(intUserID) as intCount FROM users WHERE strUserID = :strUserID");
	$query->bindParam(":strUserID", $strUsername);
	$query->execute();
	$arrRow = $query->fetch(PDO::FETCH_ASSOC);
	return ($arrRow['intCount'] > 0) ? 1 : 0;
}

function login($strUsername, $strPassword) {
	$objDB = new Database();
	$strPassword = md5($strPassword);
	$query = $objDB->prepare("SELECT intUserID FROM users WHERE strUserID = :strUserID AND strPassword = :strPassword");
	$query->bindParam(":strUserID", $strUsername);
	$query->bindParam(":strPassword", $strPassword);
	$query->execute();
	$arrRow = $query->fetch(PDO::FETCH_ASSOC);
	return isset($arrRow['intUserID']) ? true : false;
}

function get_user_id($strUsername) {
	$objDB = new Database();
	$query = $objDB->prepare("SELECT intUserID FROM users WHERE strUserID = :strUserID");
	$query->bindParam(":strUserID", $strUsername);
	$query->execute();
	$arrRow = $query->fetch(PDO::FETCH_ASSOC);
	return $arrRow['intUserID'];
}

function register_user($arrRegisterData) {
	$objDB = new Database();
	$arrRegisterData['strPassword'] = md5($arrRegisterData['strPassword']);
	
	$strComma = "";
	$strSQL = "INSERT INTO users SET ";
	
	foreach($arrRegisterData as $strFieldTitle => $strFieldData){
		$strSQL .= $strComma . $strFieldTitle . " = " . $objDB->quote($strFieldData);
		$strComma = ",";
	}
	
	return $objDB->query($strSQL);
}

?>