<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Student Survey</title>
<link rel="stylesheet" type="text/css" href="CSS/main.css" media="screen" />
<script type='text/javascript' src='check.js'></script>
</head>
<body onload="if (document.forms.length > 0) document.forms[0].elements[0].focus();">
<h1>Student Computing Survey</h1>
<div id="container"><div id="form_div">
<?php
require_once('lib/db.config'); // file that contains database connection information

$errors = array();
$show_form = TRUE;

try {

 // establish a connection to the database
 $db = connectDB();  

 // Set the values for the various checkboxes and radio buttons 
 $majorsList = array ( 'BUS' => 'Business', 'SOC' => 'Social Science', 'SCI' => 'Science',
            'ART' => 'Arts or Languages','ENG'=> 'Engineering', 'OTH' => 'Other');
 $mediaList = array ('FB' => "Facebook", 'TW' => "Twitter", 'TT' => "Tumblr",
             'LI' => "LinkedIn", 'PI' => "Pinterest");
 $hoursList = array ('1' => "0-2", '4' => "3-5", '7' => "6-8", '10' => "More than 9");
 
 $name = $major = $hours = $feedback = NULL;
			
 if (isset($_POST['submitButton'])) {  
   
   // set default empty values
   $media = array();

   // Set the values from the form, strip and trim the text
   $name = strip_tags(trim($_POST['name']));  
   $major = strip_tags(trim($_POST['major']));
   $hours = strip_tags(trim($_POST['hours']));
   $feedback = strip_tags(trim($_POST['feedback']));
   
   $token =  strip_tags(trim($_POST['token']));
   
   $media = $_POST['media'];

   // Check for required inputs
   if (strlen($name) < 5) {
	   $errors[] = "Name is too short.";
   }
   if (strlen($major) == 0) {
	   $errors[] = "Major was not selected.";
   }
   if (strlen($hours) == 0) {
	   $errors[] = "Number of hours was not chosen.";
   }
   
   // Check for required number of checkboxes in media (minimum two)
   if (count($_POST['media']) < 2 ) {
	   $errors[] = "Two social media options were not chosen.";
   }
   
   if (count($errors) == 0) {
	   // OK to save to database
	   $show_form = FALSE;
	   $statement = $db->prepare("INSERT INTO `survey_answers` SET ".
	    "id = :id, ".
        "name = :name, ".
        "hours = :hours, ".
        "major = :major, ".
        "feedback = :comments, ".
        "media = :media");
       $statement->bindParam(":id",$token);
       $statement->bindParam(":name",$name);
       $statement->bindParam(":hours",$hours);
       $statement->bindParam(":major",$major);
       $statement->bindParam(":comments",$feedback);
       $statement->bindValue(":media",implode(',',$media));
       $statement->execute();

	   // Show some statistics
	   echo "<p>Thank you for taking the time to complete our survey.";
       echo "<p>Your confirmation number is ".$token.".</p>";
	   echo "<p style='font-weight: bold;'>Participants by Major as of ".date("Y-m-d H:i")."</p>";
	   echo "<table class='results'>";
	   echo "<tr><th>Major</th><th>Count</th></tr>";
	   $result = $db->query("SELECT major, count(*) from `survey_answers` GROUP BY major");
	   $resultArray = $result->fetchAll();
	   foreach ($resultArray as $row) {
		   echo "<tr><td>{$majorsList[$row[0]]}</td><td>{$row[1]}</td></tr>";
	   }
	   echo "</table>";
	   
   } else {
	   // Show the errors
	   echo "<p>The data was not saved due to errors:</p>";
	   echo "<ol class='error'>";
	   foreach ($errors as $error) {
		   echo "<li>$error</li>";
	   }
	   echo "</ol>";
   }
 }

 if ($show_form) {
?>


<form id='survey' action='' method='post' onsubmit='return checkFormData(this)'>
<div id='name'>
<p><label class='text' for=text_name'>What is your name (optional)?</label> <input id='text_name' name='name' type='text' value='<?php echo htmlentities($name); ?>' /></p>
</div><div id='major'>
<p><label class='select' for=select_major'>What is your major program of study?</label> 
<select name='major' id='select_major'  > 
<option value=''>Please Select...</option> 
<?php  // Display the options from the array
foreach ($majorsList as $value => $label) {
  echo '<option value="'.htmlentities($value).'" ';
  if ($major == $value) echo " selected ";
  echo '> '.htmlentities($label).'</option>';
}
?>
</select></p>
</div><div id='hours'>
<p>How many hours a day do you spend on the computer?</p>
<?php  // Display the radio buttons from the array
foreach ($hoursList as $value => $label) {
  echo "<label class='item'><input type='radio' name='hours' value='".htmlentities($value)."' ";
  if ($hours == $value) echo " checked ";
  echo " /> ".htmlentities($label)."</label><br />";	
}
?>
</div><div id='media'>
<p>What are your two favourite social media sites?</p> 
<?php  // Display the checkboxes from the array. Notice the name media[]
foreach ($mediaList as $value => $label) {
   echo "<label class='item'><input type='checkbox' name='media[]' value='".htmlentities($value)."' ";
   if (@in_array($value,$media)) echo " checked ";
   echo " /> ".htmlentities($label)."</label><br />";
}
?>
</div><div id='feedback'>
<p>Any additional feedback for the survey?</p><p><textarea name="feedback">
<?php echo htmlentities($feedback); ?></textarea></p>
</div><p class='submit'><input name='submitButton' id='submitButton' type='submit' value='Submit'/></p>
<input type='hidden' name='token' value='<?php echo uniqid();  ?>' />
</form>
<?php 

}


} catch (Exception $e) {
	echo $e->getMessage();
}

?>
</div></div>
</body></html>
