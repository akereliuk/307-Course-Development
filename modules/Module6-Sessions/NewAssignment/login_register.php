<?php

// This script will allow a user to login or register of they don't have an existing login
// It will use two additional files:
//    db_info.php -- Database connection information
//    login_register_form.php -- The PHP script that will display the actual form

// This script will process the form data.
  // If the user has successfully logged on or registered, the following session variables are set:
  //  $_SESSION['auth'] is set to TRUE
  //  $_SESSION['auth_info'] is set to the an array of relevant information:
  //      'fusername' => the logged in user name
  //      'first_name' => the users first nane (from the database)
  //      'last_name' => the users last name (from the database)
  //
  // User information is stored in the users table

session_start();	

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
   // There is no data to check, show the form
   include("login_register_form.php");
   exit;
}

try {
  require_once ("db_info.php");    // the database will be opened at the object in $db

  switch ($_POST['Button'])	{
    case "Login":	
      $stmt = $db->prepare("SELECT user_name FROM users WHERE user_name=:name AND password = MD5(:password)");
      $stmt->bindValue(":name",trim($_POST['fusername']));
      $stmt->bindValue(":password",trim($_POST['fpassword']));
	  $stmt->execute();
      if($stmt->rowCount() == 1) {
		 // Password matches
         $_SESSION['auth'] = TRUE;          
         $user_data = $stmt->fetchAll(PDO::FETCH_ASSOC);		 
         $_SESSION['auth_info'] = $user_data[0];
		 header("Location: index.php");              // redirect to the protected page   
         exit;      	
      } else  {
		 // password does not match - set an error message variable and show the form again             	
         $message_1 = "The login name and/or password you have entered is not correct. Please try again.";
         include("login_register_form.php");
         exit;
      }	                                                  
      break;                                                 	

    case "Register":          
      // The user is trying to register  
      // Check the data first.
	  $message_2 = NULL;
	  if (strlen(trim($_POST['user_name'])) < 2) {
		  $message_2 .= "Username is too short.";
	  }
	  if (strlen(trim($_POST['password'])) < 5) {
	      $message_2 .= "Password is too short.";
	  }
      if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		  $message_2 .= "E-mail address is not valid.";
	  }
	  if (strlen(trim($_POST['first_name'])) < 1) {
	      $message_2 .= "First name is too short.";
	  }
      if (strlen(trim($_POST['last_name'])) < 2) {
	      $message_2 .= "Last Name is too short.";
	  }
	  // see if the username already exists
      $stmt = $db->prepare("SELECT user_name FROM users WHERE user_name=:name");
      $stmt->bindValue(":name",trim($_POST['user_name']));
	  $stmt->execute();
      if($stmt->rowCount() == 1) {
          $message_2 .= "That username already exists. Please try another.";
      }

	  if(strlen($message_2) > 0) { 
         include("login_register_form.php");
         exit();
      } 
    
	  // Save the new user to the database

      $today = date("Y-m-d H:i:s");                   

	  $add_stmt = $db->prepare("INSERT INTO users VALUES (:username, :today, md5(:password), :first, :last, :street, :city, :prov, :postal, :phone, :email)");
      $add_stmt->bindValue(":today",$today);
      $add_stmt->bindValue(":username",trim($_POST['user_name']));
      $add_stmt->bindValue(":password",trim($_POST['password']));
      $add_stmt->bindValue(":first",trim($_POST['first_name']));
      $add_stmt->bindValue(":last",trim($_POST['last_name']));
      $add_stmt->bindValue(":street",trim($_POST['street']));
      $add_stmt->bindValue(":city",trim($_POST['city']));
      $add_stmt->bindValue(":prov",trim(strtoupper($_POST['prov'])));
      $add_stmt->bindValue(":postal",trim(strtoupper($_POST['postal_code'])));
      $add_stmt->bindValue(":phone",trim($_POST['phone']));
      $add_stmt->bindValue(":email",trim($_POST['email']));
      $add_stmt->execute();

      if ($add_stmt->rowCount() != 1) {
          $message_2 .= "There was a problem saving your data to the database. Try again later.";
	  }	else {
		  // Query the database and set the session variables
		  $stmt = $db->prepare("SELECT * FROM users WHERE user_name=:name AND password = MD5(:password)");
          $stmt->bindValue(":name",trim($_POST['user_name']));
          $stmt->bindValue(":password",trim($_POST['password']));
	      $stmt->execute();
          if($stmt->rowCount() == 1) {
			 // Set the session variables (from data in the database)
			 $_SESSION['auth'] = TRUE;          
             $user_data = $stmt->fetchAll(PDO::FETCH_ASSOC);		 
             $_SESSION['auth_info'] = $user_data[0];
             
             // send email to new user
             $emess = "You have successfully registered. \n";
             $emess .= "Your new user name is: {$user_data[0]['user_name']}\n";
             $emess .= "We appreciate your interest. \n\n";
             $emess .= "If you have any questions or problems,";
             $emess .= " email service@ourplace.com";         	     	
             mail(trim($user_data[0]['email']),"Thank you for Your Registration",$emess);       	

			 // Send to login page
             header("Location: index.php");
             exit;	
          }
	  }		  

      break;                                               	

  default:                                             	
       include("login_register_form.php");
	   
  }  // end switch


} catch (Exception $e) {
   echo $e->getMessage();
}

?>
