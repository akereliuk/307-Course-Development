<?php

// This script will allow a user to login or register of they don't have an existing login

session_start();	   
include("lib/form_fields.inc");

// See if this is being called in response to a form submission...
                                       
switch (@$_POST['Button'])	                               
{
  case "Login":	                                          
    include("lib/dbstuff.inc");	    
    $query = $db->stmt_init();	
    $query->prepare("SELECT user_name FROM Customer 
              WHERE user_name=? AND password = MD5(?)");
	$query->bind_param("ss",$_POST['fusername'],$_POST['fpassword']);
	$result = $query->execute();
	$query->store_result(); // force the setting of num_rows (see PHP manual)
	if (!$result) die("Query died: fuser_name");                    	
    if($result && $query->num_rows > 0) {
		// Password matches
        $_SESSION['auth']="yes";                         	
        $_SESSION['logname'] = $_POST['fusername'];      	
        header("Location: index.php");     // redirect to the protected page         	
    }  else  {
		// password does not match - set an error message variable and show the form again             	
        $message_1 = "The login name and/or password you have entered is not correct. ".
		            "Please try again.";
        $fusername = strip_tags(trim($_POST['fusername']));
        include("lib/display_form.inc");
    }	                                                  
  break;                                                 	

  case "Register":                                       	
    // Validation Step 1 - make sure all fields have a value
	$errors = 0;
    foreach($_POST as $column_name => $value) {
		if (array_key_exists($column_name,$fields_2)) {
		  $check_value = strip_tags($value);  
		  if (isset($fields_2[$column_name]['regexp'])) {

			// If this field/column has a regular expression, check the submitted value
			if (preg_match($fields_2[$column_name]['regexp'],$check_value) == 0) {
				$fields_2[$column_name]['error'] = "Invalid data";
				$errors++;
			}
		  }
		  $fields_2[$column_name]['value'] = $check_value;
		}
    }    

    if($errors > 0)	{ 
      $message_2 = "Your registration was not saved due to $errors error(s). Please correct the problems indicated and submit again.";
      include("lib/display_form.inc");
      exit();
    } 

    // If the script made it this far, the data has passed validation.	

    /* check to see if user name already exists */
    include("lib/dbstuff.inc");	                            
	$query = $db->stmt_init();
    $query->prepare("SELECT user_name FROM Customer WHERE user_name=?");      
    $query->bind_param("s",$_POST['user_name']);
	$result = $query->execute();
	$query->store_result(); // force the setting of num_rows (see PHP manual)
	
    if (!$result) die("Query Error: user_name.");
                   	
    if($result && $query->num_rows > 0){
      $message_2 = "{$_POST['user_name']} already used. Select another User Name.";
      include("lib/display_form.inc");
      exit();
    } 

    $today = date("Y-m-d");                           	
	$query = $db->stmt_init();
    $query->prepare("INSERT INTO Customer (user_name,create_date,
                password,first_name,last_name,street,city,
                prov,postalcode,phone,email) VALUES (?, ?, md5(?), ?, ?, ?, ?, ?, ?, ?, ?)");
	$query->bind_param("sssssssssss", $fields_2['user_name']['value'],
	  $today, $fields_2['password']['value'],
	  $fields_2['first_name']['value'], $fields_2['last_name']['value'],
	  $fields_2['street']['value'], $fields_2['city']['value'],
	  
	  $fields_2['prov']['value'], $fields_2['postalcode']['value'],
	  $fields_2['phone']['value'], $fields_2['email']['value']);

	$result = $query->execute();
	if (!$result) {
		die ("Query Error: INSERT");
	}
	
	// set the session variables
    $_SESSION['auth']="yes";                          	
    $_SESSION['logname'] = $fields_2['user_name']['value'] ;
	
      /* send email to new Customer */
      $emess = "You have successfully registered. ";
      $emess .= "Your new user name is: ";
      $emess .= "\n\n\t{$fields_2['user_name']['value']}\n\n";
      $emess .= "We appreciate your interest. \n\n";
      $emess .= "If you have any questions or problems,";
      $emess .= " email service@ourstore.com";         	     	
      mail($fields_2['email']['value'],"Thank you for Your Registration",$emess);       	
      header("Location: index.php");              	

  break;                                               	

  default:                                             	
    include("lib/display_form.inc");
}  // end switch
?>
