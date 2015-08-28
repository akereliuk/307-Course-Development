<?php
	include_once "users.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>File Uploading</title>
		<?php include_once "stylesheet.php"; ?>
	</head>
	<body>
		<?php
			include_once "navigation.php";
	
			$arrErrors = array();
			if(!empty($_POST)){
				$strUsername = $_POST['strUserID'];
				$strPassword = $_POST['strPassword'];
				if (empty($strUsername) === true || empty($strPassword) === true) {
					 $arrErrors[] = "Error: You need to enter a username and password";
				}
				else{
					$blnLogin = login($strUsername, $strPassword);
					
					if($blnLogin === false) {
						$arrErrors[] = 'Error: Incorrect login';
					}
					else{
						$_SESSION['userID'] = $strUsername;
						$_SESSION['intUserID'] = get_user_id($strUsername);
					}
				}
			}
			else{
				$arrErrors[] = "Error: Access denied";
			}
			
			echo "<div class='content'>";
					
			if(!empty($arrErrors)){
				foreach($arrErrors as $key => $value){
					echo $value . "<br/>";
				}
				echo "</div>";
			}
			else{
				header('Location: index.php');
				exit;
			}
		?>
	</body>
</html>