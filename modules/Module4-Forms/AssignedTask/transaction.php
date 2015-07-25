<?php
	include_once("lib/db.config");
	
	$db = connectDB();
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	$query = $db->prepare("INSERT INTO survey (strName, strMajor) VALUES (:strName, :strMajor)");
	$query->bindParam(":strName", $_POST['name']);
	$query->bindParam(":strMajor", $_POST['major']);
	$blnSuccess = $query->execute();
	
	$intSurveyID = $db->lastInsertId();
	
	foreach($_POST['question'] as $key => $value){
		$query = $db->prepare("INSERT INTO answer (intQuestionID, strAnswer, intSurveyID) VALUES (:intQuestionID, :strAnswer, :intSurveyID)");
		$intQuestionID = $key+1;
		$query->bindParam(":intQuestionID", $intQuestionID);
		$query->bindParam(":strAnswer", $value);
		$query->bindParam(":intSurveyID", $intSurveyID);
		$query->execute();
	}
	
	if($blnSuccess){
		echo "Your survey has been submitted successfully. Thank you.";
	}
	else{
		echo "There was an error with your survey submission. Please try again.";
	}
	
	echo "<br/><a href='submission.php'>Return to Submission Page</a>";
?>