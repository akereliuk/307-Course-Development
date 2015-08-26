<html>
	<head>
		<title>User Settings</title>
		<?php include_once "stylesheet.php"; ?>
	</head>
	<body>
		<?php include_once "navigation.php"; ?>
		<div class='content'>
			<h3>Customize Skin</h3>
			<h4>Current Skin: <?=((!isset($_COOKIE['sitestyle'])) ? 'Default' : $_COOKIE['sitestyle'])?></h4>
			<a href="switcher.php?set=main">Default</a><br />
			<a href="switcher.php?set=blue">Blue</a><br />
			<a href="switcher.php?set=red">Red</a>
		</div>
	</body>
</html>