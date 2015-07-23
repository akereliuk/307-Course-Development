<html>
	<head>
		<title>Simple Form</title>
		<link rel="stylesheet" type="text/css" href="CSS/main.css" media="screen" />
	</head>
	<body>
		<form>
			Name: <input type='text' name='name'/>
			Major: <select name='major'>
						<option>Business</option>
						<option>Social Science</option>
						<option>Political Science</option>
						<option>English</option>
						<option>Engineering</option>
						<option>Other</option>
					</select>
			<hr/>
			<div class='question'>1. How many hours a day do you spend on the computer?</div>
			<div class='answer'>
				<input type='radio' name='question1' value='0-2'/>0-2
				<input type='radio' name='question1' value='3-5'/>3-5
				<input type='radio' name='question1' value='6-8'/>6-8
				<input type='radio' name='question1' value='9+'/>9+
			</div>
			<div class='question'>2. What activities do you prefer to engage in on a computer? (Select all that apply)</div>
			<div class='answer'>
				<input type='checkbox' name='question2option1'/>Social Media
				<input type='checkbox' name='question2option2'/>Gaming
				<input type='checkbox' name='question2option3'/>Programming
				<input type='checkbox' name='question2option4'/>Graphic Design
				<input type='checkbox' name='question2option5'/>Browsing the Web
			</div>
			<div class='question'>3. What is your preferred social media website?</div>
			<div class='answer'>
				<input type='radio' name='question3' value='Facebook'/>Facebook
				<input type='radio' name='question3' value='Twitter'/>Twitter
				<input type='radio' name='question3' value='Tumblr'/>Tumblr
				<input type='radio' name='question3' value='Other'/>Other
			</div>
			<div class='question'>4. Any additional feedback for the survey?</div>
			<div class='answer'>
				<textarea rows='4' cols='50' name='question4'></textarea>
			</div>
			<input type='submit' value='Submit'/>
		</form>
	</body>
</html>