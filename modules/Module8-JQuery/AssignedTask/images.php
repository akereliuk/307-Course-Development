<?php
	include_once "Database.class";
	
	if(isset($_POST['action'])){
		$action = $_POST['action'];
		switch($action){
			case 'likeImage' : likeImage($_POST['intImageID'], $_POST['intUserID']); break;
			case 'unlikeImage' : unlikeImage($_POST['intImageID'], $_POST['intUserID']); break;
			default: break;
		}
	}
	
	function uploadImage($arrImageData){
		$objDB = new Database();
		
		$strComma = "";
		$strSQL = "INSERT INTO images SET ";
		
		foreach($arrImageData as $strFieldTitle => $strFieldData){
			$strSQL .= $strComma . $strFieldTitle . " = " . $objDB->quote($strFieldData);
			$strComma = ",";
		}
		
		$success = $objDB->query($strSQL);
		return $success;
	}
	
	function retrieveImages(){
		$objDB = new Database();
		$arrReturn = array();
		
		$strSQL = "SELECT * FROM images";
		$rsResult = $objDB->query($strSQL);
		
		while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$arrReturn[$arrRow['intImageID']] = $arrRow['strImageName'];
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
	
	function getLikesBar($intImageID, $intUserID){
		if(isLiked($intImageID, $intUserID)){
			return "<center><a href=\"javascript:unlikeImage('" . $intImageID . "', '" . $intUserID . "')\">Unlike</a> | " . getLikedCount($intImageID) . " Likes</center></td>";
		}
		else{
			return "<center><a href=\"javascript:likeImage('" . $intImageID . "', '" . $intUserID . "')\">Like</a> | " . getLikedCount($intImageID) . " Likes</center></td>";
		}
	}
	
	function getGuestLikesBar($intImageID){
		return "<center>" . getLikedCount($intImageID) . " Likes</center></td>";
	}
	
	function isLiked($intImageID, $intUserID){
		$objDB = new Database();
		$query = $objDB->prepare("SELECT COUNT(intImageID) as intCount FROM likedphotos WHERE intImageID = :intImageID AND intUserID = :intUserID");
		$query->bindParam(":intImageID", $intImageID);
		$query->bindParam(":intUserID", $intUserID);
		$query->execute();
		$arrRow = $query->fetch(PDO::FETCH_ASSOC);
		return ($arrRow['intCount'] > 0) ? 1 : 0;
	}
	
	function getLikedCount($intImageID){
		$objDB = new Database();
		$query = $objDB->prepare("SELECT COUNT(intImageID) as intCount FROM likedphotos WHERE intImageID = :intImageID");
		$query->bindParam(":intImageID", $intImageID);
		$query->execute();
		$arrRow = $query->fetch(PDO::FETCH_ASSOC);
		return $arrRow['intCount'];
	}
	
	function likeImage($intImageID, $intUserID){
		$objDB = new Database();
		$query = $objDB->prepare("INSERT INTO likedphotos (intImageID, intUserID, dtmLikedOn) VALUES (:intImageID, :intUserID, NOW())");
		$query->bindParam(":intImageID", $intImageID);
		$query->bindParam(":intUserID", $intUserID);
		$query->execute();
		echo "<center><a href=\"javascript:unlikeImage('" . $intImageID . "', '" . $intUserID . "')\">Unlike</a> | " . getLikedCount($intImageID) . " Likes</center></td>";
	}
	
	function unlikeImage($intImageID, $intUserID){
		$objDB = new Database();
		$query = $objDB->prepare("DELETE FROM likedphotos WHERE intImageID = :intImageID AND intUserID = :intUserID");
		$query->bindParam(":intImageID", $intImageID);
		$query->bindParam(":intUserID", $intUserID);
		$query->execute();
		echo "<center><a href=\"javascript:likeImage('" . $intImageID . "', '" . $intUserID . "')\">Like</a> | " . getLikedCount($intImageID) . " Likes</center></td>";
	}
?>