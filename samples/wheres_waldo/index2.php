<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Where's Waldo</title>
	<style>
	.fullwidth {
		width: 100%;
	}
	form, p {
	     text-align: center;
    }
    .error {
         color: red;
    }
    .success {
    	 color: green;
    }
	</style>
</head>
<body>
<?php
$total_time = 0;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	 //
	 // This script has been called with form data. Process it
	 //
	 
	 if (!isset($_POST['timestamp'])) {
	    echo "<p class='error'>There was an error in the form.</p>";
	 } else {
	 	$seconds_to_find = time() - $_POST['timestamp'];
	 	$total_time = $_POST['totaltime'] + $seconds_to_find;
	 	echo "<p class='success'>You found him in $seconds_to_find seconds.</p>";
	 }
	 
} 
//
// Display the form
//

// (1) Get a list of images from the folder called pics
// (1A) But check to make sure that it hasn't been seen before.

// seenlist is a string that contains a list of filenames that we have seen before.  
// Each entry is enclosed by brackets. Eg. (pic1.jpg)(pic2.jpg)(pic15.jpg)

if (isset($_POST['seenlist']))
  $seenlist = $_POST['seenlist'];
else
  $seenlist = "";
    
$files = scandir("pics");
$pics = array ();
foreach ($files as $file) {
    if ($file{0} != "." && strpos($seenlist, "(".$file.")") === FALSE) {
        $pics[] = $file;
    }
}
    
// (2) Choose one at random, and display it

$max_index = count($pics) -1;

if ($max_index == -1 ) {

   echo "<p class='success'>Congratulations, you are done!</p>";
   echo "<p class='success'>It took you a total of $total_time seconds in total.</p>";
   
} else {
   $rand = rand(0,$max_index);
    
   echo "<img src='pics/{$pics[$rand]}' class='fullwidth' />";
    
// (2A) Add the randomly selected one to the seenlist

  $seenlist .= "(".$pics[$rand].")";
    
// (3) Build up a form, and pass the current time to the form, so that it will get
//     sent to the browser, and send back to us.
	
	echo "<p> When you have found him, click the button.</p>";
	
	echo "<form action='{$_SERVER['PHP_SELF']}' method='POST'>";
	echo "<input type='hidden' name='seenlist' value='".$seenlist."' />";
	echo "<input type='hidden' name='timestamp' value='".time()."' />";
	echo "<input type='hidden' name='totaltime' value='$total_time' />";
	echo "<input type='submit' name='found_him' value='Waldo has been located' >";
	echo "</form>";
}
?>
</body>
</html>
