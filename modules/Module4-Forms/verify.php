<html>
	<head>
		<title>Simple Form</title>
		<link rel="stylesheet" type="text/css" href="CSS/main.css" media="screen" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type='text/javascript' src='common.js'></script>
	</head>
	<body>
		<h3>Survey Verification</h3>
		<form method='post'>
			<b>Name:</b> <?=$_POST['name']?><br/>
			<input type='hidden' name='name' value='<?=$_POST['name']?>'/>
			
			<b>Major:</b> <?=$_POST['major']?>
			<input type='hidden' name='major' value='<?=$_POST['major']?>'/>
			
			<hr/>
			
			<div class='question'>1: How many hours a day do you spend on the computer?</div>
			<div class='answer'><?=$_POST['question'][0]?></div>
			<input type='hidden' name='question[0]' value='<?=$_POST['question'][0]?>'/>
			
			<div class='question'>2: What activity do you prefer to engage in on a computer?</div>
			<div class='answer'><?=$_POST['question'][1]?></div>
			<input type='hidden' name='question[1]' value='<?=$_POST['question'][1]?>'/>
			
			<div class='question'>3: What is your preferred social media website?</div>
			<div class='answer'><?=$_POST['question'][2]?></div>
			<input type='hidden' name='question[2]' value='<?=$_POST['question'][2]?>'/>
			
			<div class='question'>4: Any additional feedback for the survey?</div>
			<div class='answer'><?=$_POST['question'][3]?></div>
			<input type='hidden' name='question[3]' value='<?=$_POST['question'][3]?>'/>
			
			<input type='submit' formaction='submission.php' value='Return'/>
			<input type='submit' formaction='transaction.php' value='Submit'/>
		</form>
	</body>
</html>