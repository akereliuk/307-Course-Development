<?php
// On-Line Voting Sample Application - 60-307 (Version 1)
// Front-End

// IN ANY CASE, LET'S LOAD IN THE CURRENT QUESTION AND THE RESPONSES

require_once("voting/db.config");

$stmt = "SELECT id, r_id, question, response, responses.total_votes as total_votes, 
          questions.total_votes as q_total_votes, date_end  FROM questions 
          JOIN responses  ON questions.id = responses.q_id 
          WHERE CURDATE() between date_start AND date_end 
          ORDER BY questions.id, responses.response";

$result = $db->query($stmt);
if (!$result) { 
  setcookie("vote_history", NULL , time()-3600);  // unset the cookie by setting an expire time in the past
  echo "<p class='error'>".$db->error."</p>";
  exit(0);
}
// We will fetch the entire result of the query into an associative array
$data_array = $result->fetch_all(MYSQLI_ASSOC);

// The question id is the first column. Let's get the first row, first column
$q_id = $data_array[0]['id'];

// IS THIS A FORM SUBMISSION?  IF SO, SAVE THE DATA FROM THE INCOMING $_POST
// DO AN EXTRA CHECK TO SEE IF 

if ((isset($_POST['submit']) && $_POST['submit'] == "Vote")  && 
     @$_COOKIE['vote_history'] != $q_id &&
     @$_POST['q_id'] == $q_id) {

   // set the cookie with the expiry time set to the end of the voting period for the question
   setcookie("vote_history",$_POST['q_id'],strtotime($data_array[0]['date_end'])." 23:59:59");
   
   // Save the response
   $update_response = $db->prepare("UPDATE responses SET total_votes = total_votes + 1 WHERE r_id = ?");
   $update_response->bind_param('d',$_POST['response']);
   $update_response->execute();
   
   // update the total vote count in the question table
   $update_question = $db->prepare("UPDATE questions SET total_votes = total_votes + 1 WHERE id = ?");
   $update_question->bind_param('d',$_POST['q_id']);
   $update_question->execute(); 
   
   // instruct the browser to reload this page, to force the cookie to be sent to the browser
   header("Location: ".$_SERVER['PHP_SELF']); 
} 

?><!DOCTYPE html !>
<html>
<head> <meta charset="UTF-8"> 
<title>Poll Application</title></head>
<link rel="stylesheet" href="voting/bar_style.css" />
<body>
<?php
if (count($data_array) == 0) {

  echo "<div class='q_class'><div class='q_question'>There is no question for today.</div></div>";

} else {

  // Check to see if the cookie is set, 
  if (isset($_COOKIE['vote_history']) && $_COOKIE['vote_history'] == $q_id ) {

     // display the results
     echo "<div class='q_class'>";
     echo "<div class='q_question'>";
     echo $data_array[0]['question'];
     echo "</div>";

     foreach ($data_array as $question) {
       if ($question['id'] == $q_id) { // handle a case where multiple questions are open
         echo "<div class='q_responses'>";
	     echo "<div class='q_responses_radio'>";
	     echo $question['total_votes'];
	     echo "</div>";
	     echo "<div class='q_responses_text'>";
         echo $question['response'];
         $width = ceil( $question['total_votes'] / (float) $question['q_total_votes'] * 450);
         echo "<br /><div class='graph_outer'><div class='graph_inner' style='width:".$width."px;'>&nbsp;</div></div>";
	     echo "</div>";
         echo "</div>";
      }
     }
	 echo '<div style="clear:both;" class="q_question">Thank you for voting</div>';

  } else {

     // Otherwise display the form
     echo "<form action='".$_SERVER['PHP_SELF']."' method='POST' name='question_form'>";
     echo "<div class='q_class'>";
     echo "<div class='q_question'>";
     echo $data_array[0]['question'];
     echo "</div>";

    foreach ($data_array as $question) {
      if ($question['id'] == $q_id) { // handle a case where multiple questions are open
        echo "<div class='q_responses'>";
	    echo "<div class='q_responses_radio'>";
	    echo "<input type='radio' name='response' value='".$question['r_id']."' />";
	    echo "</div>";
	    echo "<div class='q_responses_text'>";
        echo $question['response'];
	    echo "</div>";
        echo "</div>";
      }
    } ?>
  <div style="clear:both;" class="q_question">
  <input type="hidden" name="q_id" value="<?php echo $q_id; ?>" />
  <input type="submit" name="submit" value="Vote" /></div>
  </div></form>
<?php } } ?>
</body>
</html>