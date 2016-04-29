<?php
 // User login and registration combination form.
	                                 
?><!DOCTYPE html>
<html>
<head><title>User Login Page</title>
<link rel="stylesheet" href="login_register_form.css" />
<script>
function setFieldData() {
	document.forms['login']['fusername'].focus();  // set focus to the first field
	// This will set the values of the form fields if they were sent in the HTTP request
	// This implements the sticky form
<?php
   // See if the relevant values have been set. If so, sent the JavaScript code
   if (isset($_POST['fusername']))
      echo "document.forms['login']['fusername'].value = ".json_encode(trim($_POST['fusername'])).";";
   if (isset($_POST['user_name']))
      echo "document.forms['reg']['user_name'].value = ".json_encode(trim($_POST['user_name'])).";";
   if (isset($_POST['password']))
      echo "document.forms['reg']['password'].value = ".json_encode(($_POST['password'])).";";
   if (isset($_POST['password2']))
      echo "document.forms['reg']['password2'].value = ".json_encode(($_POST['password2'])).";";
   if (isset($_POST['first_name']))
      echo "document.forms['reg']['first_name'].value = ".json_encode(trim($_POST['first_name'])).";";
   if (isset($_POST['last_name']))
      echo "document.forms['reg']['last_name'].value = ".json_encode(trim($_POST['last_name'])).";";
   if (isset($_POST['street']))
      echo "document.forms['reg']['street'].value = ".json_encode(trim($_POST['street'])).";";
   if (isset($_POST['city']))
      echo "document.forms['reg']['city'].value = ".json_encode(trim($_POST['city'])).";";
   if (isset($_POST['prov']))
      echo "document.forms['reg']['prov'].value = ".json_encode(trim($_POST['prov'])).";";
   if (isset($_POST['postal_code']))
      echo "document.forms['reg']['postal_code'].value = ".json_encode(trim($_POST['postal_code'])).";";
   if (isset($_POST['phone']))
      echo "document.forms['reg']['phone'].value = ".json_encode(trim($_POST['phone'])).";";  
   if (isset($_POST['email']))
      echo "document.forms['reg']['email'].value = ".json_encode(trim($_POST['email'])).";"; 
?>
}
function checkReg() {
	// Check some data in the registration form
	if (document.forms['reg']['password'].value != document.forms['reg']['password2'].value) {
		document.forms['reg']['password'].style.backgroundColor = 'lightyellow';
		document.forms['reg']['password2'].style.backgroundColor = 'lightyellow';
		return false;
	}
}
</script>
</head>
<body onload="setFieldData()">
<div id="wrapper">
 <div id="login">
  <form action="" method="POST" name="login">
    <fieldset>
      <legend>Login Form</legend>
<?php  if (isset($message_1)) { 
         echo "<p class='errors'>$message_1</p>\n";
       } ?>
       <div class='field'><label for='fusername'>User Name</label>
	     <input type='text' required name='fusername' maxlength='50' /></div>
       <div class='field'><label for='fpassword'>Password</label>
	     <input type='password' required name='fpassword' maxlength='50' /></div>
      <input type="submit" name="Button" value="Login" />
    </fieldset> 
  </form>
  <p class="instructions">If you already have an account, log in above.</p>
  <p class="instructions">If you do not have an account, register now to the right.</p>
 </div>
 <div id="reg">
  <form action='' name="reg" method="POST" onsubmit="return checkReg();">
    <fieldset>
     <legend>Registration Form</legend>
<?php if(isset($message_2))	{
         echo "<p class='errors'>$message_2</p>\n";
       } ?>
       <div class='field'><label for='user_name'>User Name</label>
	     <input type='text' required name='user_name' maxlength='50' /></div>
       <div class='field'><label for='password'>Password</label>
	     <input type='password' required name='password' maxlength='50' /></div>
	   <div class='field'><label for='password2'>Password Confirm</label>
	     <input type='password' required name='password2' maxlength='50' /></div>
       <div class='field'><label for='email'>Email Address</label>
	     <input type='text' required name='email' maxlength='100' /></div>
       <div class='field'><label for='first_name'>First Name</label>
	     <input type='text' required name='first_name' maxlength='50' /></div>
       <div class='field'><label for='last_name'>Last Name</label>
	     <input type='text' required name='last_name' maxlength='50' /></div>
       <div class='field'><label for='street'>Street Address</label>
	     <input type='text' name='street' maxlength='100' /></div>
       <div class='field'><label for='city'>City</label>
	     <input type='text' name='city' maxlength='100' /></div>
       <div class='field'><label for='prov'>Province</label>
	     <input type='text' name='prov' maxlength='2' /></div>
       <div class='field'><label for='postal_code'>Postal Code</label>
	     <input type='text' name='postal_code' maxlength='7' /></div>
       <div class='field'><label for='phone'>Phone Number</label>
	     <input type='text' name='phone' maxlength='50' /></div>
       <input type="submit" name="Button" value="Register">
      </fieldset>
    </form>
  </div>
</div>
</body></html>



