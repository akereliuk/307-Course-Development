<?php
	session_start();
?>

<div class='navigation'>
	<a href='index.php'>
		<div class='<?=((!isset($_SESSION['userID'])) ? 'navButton' : 'navButtonLast')?> <?=((basename($_SERVER['PHP_SELF']) == 'index.php') ? 'currentTab' : '')?>'>
			Main
		</div>
	</a>
	<?php if(!isset($_SESSION['userID'])){?>
	<a href='register.php'>
		<div class='navButtonLast <?=((basename($_SERVER['PHP_SELF']) == 'register.php') ? 'currentTab' : '')?>'>
			Register
		</div>
	</a>
	<?php
	} else {
	?>
	<a href='settings.php'>
		<div class='navButtonLast <?=((basename($_SERVER['PHP_SELF']) == 'settings.php') ? 'currentTab' : '')?>'>
			Settings
		</div>
	</a>
	<?php } ?>
	<div class='navButtonLogin'>
		<?php if(!isset($_SESSION['userID'])){ ?>
		<form class='loginform' action='login.php' method='post'>
			Username: <input class='useridInput' type='text' name='strUserID' size='45'/>
			Password: <input type='password' class='passwordInput' name='strPassword' size='45'/>
			<input type='submit' value='Login'/>
		</form>
		<?php }else{ ?>
			Welcome, <?=$_SESSION['userID']?>. <a href='logout.php'><u>Logout</u></a>
		<?php } ?>
	</div>
</div>