<?php
	include_once "Database.class";
	
	function uploadImage($arrImageData){
		$objDB = new Database();
		
		$strComma = "";
		$strSQL = "INSERT INTO images SET ";
		
		foreach($arrImageData as $strFieldTitle => $strFieldData){
			$strSQL .= $strComma . $strFieldTitle . " = " . $objDB->quote($strFieldData);
			$strComma = ",";
		}
		
		$objDB->query($strSQL);
	}
	
	function retrieveImages(){
		$objDB = new Database();
		$arrReturn = array();
		
		$strSQL = "SELECT * FROM images";
		$rsResult = $objDB->query($strSQL);
		
		while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$arrReturn[$arrRow['strImageName']] = $arrRow['strImageName'];
		}
		
		return $arrReturn;
	}
	
	function getDetailsFromImageName($strFileName){
		$objDB = new Database();
		
		$strSQL = "SELECT users.strUserID as strUserID, images.dtmCreatedOn as dtmCreatedOn FROM images INNER JOIN users USING (intUserID) WHERE strImageName = " . $objDB->quote($strFileName);
		$rsResult = $objDB->query($strSQL);
		
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		
		return $arrRow;
	}
?>