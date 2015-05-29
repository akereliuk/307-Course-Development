<?php
 /* File: display_form.inc
  * Desc: Contains the code for a Web page that displays
  *       two HTML forms, side by side. One is a login
  *       form, and the second is a registration form. 
  *
  * This code uses global variables $fields1 and $fields2 to get the information 
  * about the field names, labels and values
  */
	                                 
?><!DOCTYPE html>
<html>
<head><title>Customer Login Page</title>
<link rel="stylesheet" href="lib/style.css" />
</head>
<body>
<div id="wrapper">
  <div id="login">
   <form action=<?php echo $_SERVER['PHP_SELF']?>  method="POST">
      <fieldset>
        <legend>Login Form</legend>
<?php	                                                    
        if (isset($message_1))	                           
        { 
          echo "<p class='errors'>$message_1</p>\n";
        }
        foreach($fields_1 as $column_name => $field_info) {
		  if (isset($field_info['type']))
		     $type = $field_info['type'];
          else //default type is text
             $type = "text";
		  if (isset($field_info['value']))
			 $value = $field_info['value'];
		  else
			 $value = "";
		 
          echo "<div id='field'>
            <label for='$column_name'>{$field_info['label']}</label>
            <input id='$column_name' name='$column_name' type='$type' 
            value='$value' size='20' maxlength='50' />
            </div>\n";
        }	                                                #91
?>
        <input type="submit" name="Button" 
               style='margin-left: 45%; margin-bottom: .5em'
               value="Login" />
      </fieldset> 
    </form>
    <p class="instructions">
        If you already have an account, log in above.</p>
    <p class="instructions">
        If you do not have an account, register now to the right.</p>
  </div>
  <div id="reg">
    <form action=<?php echo $_SERVER['PHP_SELF']?>
          method="POST">
      <fieldset>
       <legend>Registration Form</legend>
<?php	                                                   
       if(isset($message_2))	                           
       {
         echo "<p class='errors'>$message_2</p>\n";
       }
       foreach($fields_2 as $column_name => $field_info) {
   		  if (isset($field_info['type']))
		     $type = $field_info['type'];
          else //default type is text
             $type = "text";
		  if (isset($field_info['value']))
			 $value = $field_info['value'];
		  else
			 $value = "";
		  if (isset($field_info['error']))
			 $error = "<p class='errors'>{$field_info['error']}</p>";
		  else
			 $error = "";

		 echo "<div id='field'>
             <label for='$column_name'>{$field_info['label']}</label>
             <input id='$column_name' name='$column_name' type='$type' 
             value='$value' size='40' maxlength='65' />$error
             </div>\n";
       }  // end foreach field	                          
?>
       <input type="submit" name="Button" 
          style='margin-left: 45%; margin-bottom: .5em'
          value="Register">
      </fieldset>
    </form>
  </div>
</div>
</body></html>
