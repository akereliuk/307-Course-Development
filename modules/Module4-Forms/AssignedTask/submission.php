<html>
	<head>
		<title>Simple Form</title>
		<link rel="stylesheet" type="text/css" href="CSS/main.css" media="screen" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type='text/javascript' src='common.js'></script>
	</head>
	<body>
		<h3>Survey Submission</h3>
		<form id='survey' action='verify.php' method='post'>
			<div id='name'>
				Name: <input type='text' name='name' value='<?=(isset($_POST['name']) ? $_POST['name'] : '')?>'/>
			</div>
			<div id='major'>
				Major: <select name='major'>
							<option <?php if(isset($_POST['major']) && $_POST['major'] == 'Business') echo "selected"; ?>>Business</option>
							<option <?php if(isset($_POST['major']) && $_POST['major'] == 'Social Science') echo "selected"; ?>>Social Science</option>
							<option <?php if(isset($_POST['major']) && $_POST['major'] == 'Political Science') echo "selected"; ?>>Political Science</option>
							<option <?php if(isset($_POST['major']) && $_POST['major'] == 'English') echo "selected"; ?>>English</option>
							<option <?php if(isset($_POST['major']) && $_POST['major'] == 'Engineering') echo "selected"; ?>>Engineering</option>
							<option <?php if(isset($_POST['major']) && $_POST['major'] == 'Other') echo "selected"; ?>>Other</option>
						</select>
			</div>
			<hr/>
			<div id='question0'>
				<div class='question'>1. How many hours a day do you spend on the computer?</div>
				<div class='answer'>
					<input type='radio' name='question[0]' value='0-2' <?php if(isset($_POST['question'][0]) && $_POST['question'][0] == '0-2') echo "checked='checked'"; ?>/>0-2<br/>
					<input type='radio' name='question[0]' value='3-5' <?php if(isset($_POST['question'][0]) && $_POST['question'][0] == '3-5') echo "checked='checked'"; ?>/>3-5<br/>
					<input type='radio' name='question[0]' value='6-8' <?php if(isset($_POST['question'][0]) && $_POST['question'][0] == '6-8') echo "checked='checked'"; ?>/>6-8<br/>
					<input type='radio' name='question[0]' value='9+' <?php if(isset($_POST['question'][0]) && $_POST['question'][0] == '9+') echo "checked='checked'"; ?>/>9+
				</div>
			</div>
			<div id='question1'>
				<div class='question'>2. What activity do you prefer to engage in on a computer?</div>
				<div class='answer'>
					<input type='radio' name='question[1]' value='Social Media' <?php if(isset($_POST['question'][1]) && $_POST['question'][1] == 'Social Media') echo "checked='checked'"; ?>/>Social Media<br/>
					<input type='radio' name='question[1]' value='Gaming' <?php if(isset($_POST['question'][1]) && $_POST['question'][1] == 'Gaming') echo "checked='checked'"; ?>/>Gaming<br/>
					<input type='radio' name='question[1]' value='Programming' <?php if(isset($_POST['question'][1]) && $_POST['question'][1] == 'Programming') echo "checked='checked'"; ?>/>Programming<br/>
					<input type='radio' name='question[1]' value='Graphic Design' <?php if(isset($_POST['question'][1]) && $_POST['question'][1] == 'Graphic Design') echo "checked='checked'"; ?>/>Graphic Design<br/>
					<input type='radio' name='question[1]' value='Browsing the Web' <?php if(isset($_POST['question'][1]) && $_POST['question'][1] == 'Browsing the Web') echo "checked='checked'"; ?>/>Browsing the Web
				</div>
			</div>
			<div id='question2'>
				<div class='question'>3. What is your preferred social media website?</div>
				<div class='answer'>
					<input type='radio' name='question[2]' value='Facebook' <?php if(isset($_POST['question'][2]) && $_POST['question'][2] == 'Facebook') echo "checked='checked'"; ?>/>Facebook<br/>
					<input type='radio' name='question[2]' value='Twitter' <?php if(isset($_POST['question'][2]) && $_POST['question'][2] == 'Twitter') echo "checked='checked'"; ?>/>Twitter<br/>
					<input type='radio' name='question[2]' value='Tumblr' <?php if(isset($_POST['question'][2]) && $_POST['question'][2] == 'Tumblr') echo "checked='checked'"; ?>/>Tumblr<br/>
					<input type='radio' name='question[2]' value='Other' <?php if(isset($_POST['question'][2]) && $_POST['question'][2] == 'Other') echo "checked='checked'"; ?>/>Other
				</div>
			</div>
			<div id='question3'>
				<div class='question'>4. Any additional feedback for the survey?</div>
				<div class='answer'>
					<textarea rows='4' cols='50' name='question[3]'><?=((isset($_POST['question'][3]) && $_POST['question'][3] != '') ? $_POST['question'][3] : '')?></textarea>
				</div>
			</div>
			<input type='submit' value='Submit'/>
		</form>
	</body>
</html>