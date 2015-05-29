<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Array Samples </title>
<style>
.open {
  color: green;
}
.closed {
  color: red;
}
th {
  background-color: lightgrey;
}
</style>
</head>
<body>
<h1>Traversing an Array</h1>
<?php
// -------------------------------------------------------------------------------------------------
$days = array ( "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");

$days_last_index = count($days) - 1;

echo "<p>The days of the week are: ";
foreach ($days as $i => $day) {
   echo $day;
   if ($i < $days_last_index)
     echo ", ";
}
echo ".</p>";

$current_day = date("l");
echo "<p>The days of the week are: ";
foreach ($days as $i => $day) {
   if ($day == $current_day) echo "<b>";
   echo $day;
   if ($day == $current_day) echo "</b>";
   if ($i < $days_last_index)
     echo ", ";
}
echo ".</p>";

// -------------------------------------------------------------------------------------------------
?>
<h1>Associative Array Example</h1>
<?php
// -------------------------------------------------------------------------------------------------
$days = array ("Monday" => TRUE, "Tuesday" => TRUE, "Wednesday" => TRUE, "Thursday" => TRUE, "Friday" => TRUE, "Saturday" => FALSE, "Sunday" => FALSE);

echo "<table><tr><th>Day</th><th>Status</th></tr>";
foreach ($days as $key => $value) {
   echo "<tr><td>$key</td>";
   if ($value)
     echo "<td class='open'> We are OPEN";
   else
     echo "<td class='closed'> Sorry, are CLOSED";
   echo "</td></tr>";
}
echo "</table>";
// -------------------------------------------------------------------------------------------------
?>
<h1>Array of Arrays (2 dimensional array) Example</h1>
<h2>Outer array is associative, inner array is indexed</h2>
<?php
// -------------------------------------------------------------------------------------------------
$days = array ("Monday" => array("10:00 AM", "6:00 PM"),
               "Tuesday" => array("10:00 AM", "6:00 PM"),
               "Wednesday" => array("10:00 AM", "6:00 PM"),
               "Thursday" => array("10:00 AM", "9:00 PM"),
               "Friday" => array("10:00 AM", "9:00 PM"), 
               "Saturday" => array("12:00 PM", "4:00 PM"), 
               "Sunday" => FALSE);   // sentinel or out-of-band value

echo "<table><tr><th>Day</th><th>Status</th></tr>";
foreach ($days as $key => $value) {
   echo "<tr><td>$key</td>";
   if (count($value) == 2) {
      echo "<td class='open'>We are OPEN from {$value[0]} to {$value[1]}</td>";
   } else {
      echo "<td class='closed'>Sorry, we are CLOSED.</td>";
   }
   echo "</tr>";
}
echo "</table>";
// -------------------------------------------------------------------------------------------------
?>
<h1>Array of Arrays (2 dimensional array) Example</h1>
<h2>Outer array is associative, inner array is also associative</h2>
<?php
// -------------------------------------------------------------------------------------------------
$days = array ("Monday" => array("open" => "10:00 AM", "close" => "6:00 PM"),
               "Tuesday" => array("open" => "10:00 AM", "close" => "6:00 PM"),
               "Wednesday" => array("open" => "10:00 AM", "close" => "6:00 PM"),
               "Thursday" => array("open" => "10:00 AM", "close" => "9:00 PM"),
               "Friday" => array("open" => "10:00 AM", "close" => "9:00 PM"), 
               "Saturday" => array("open" => "12:00 PM", "close" => "4:00 PM"), 
               "Sunday" => FALSE);   // sentinel or out-of-band value

echo "<table><tr><th>Day</th><th>Status</th></tr>";
foreach ($days as $key => $value) {
   echo "<tr><td>$key</td>";
   if (count($value) == 2) {
      echo "<td class='open'>We are OPEN from {$value['open']} to {$value['close']}</td>";
   } else {
      echo "<td class='closed'>Sorry, we are CLOSED.</td>";
   }
   echo "</tr>";
}
echo "</table>";
// -------------------------------------------------------------------------------------------------
?>
<h1>Inner Array is Not Consistent</h1>
<?php

$days = array ("Monday" => array("open" => "5:00 AM"),
               "Tuesday" => TRUE,
               "Wednesday" => TRUE,
               "Thursday" => TRUE,
               "Friday" => array( "close" => "9:00 PM"), 
               "Saturday" => array("open" => "6:00 AM", "close" => "9:00 PM"), 
               "Sunday" => FALSE);   

echo "<table><tr><th>Day</th><th>Status</th></tr>";
foreach ($days as $key => $value) {
   echo "<tr><td>$key</td>";
   if (is_array($value)) {
        echo "<td class='open'>We are OPEN ";
        if (array_key_exists("open",$value))
           echo "at {$value['open']} ";
        if (array_key_exists("close",$value))
           echo "until {$value['close']}";
        echo "</td>";   
   } else if ($value) {
        echo "<td class='open'>We are OPEN 24 hours.</td>";
      } else {
        echo "<td class='closed'>Sorry, we are CLOSED.</td>";
      }
   echo "</tr>";
}
echo "</table>";
// -------------------------------------------------------------------------------------------------
?>
<h1>Three Dimensional Array</h1>
<?php

$days = array ("Monday" => array(
                  array("open" => "5:00 AM", "close" => "11:00 AM", "service" => "breakfast"),
                  array("open" => "11:30 PM", "close" => "2:00 PM", "service" => "lunch"),
              ),
               "Tuesday" => array(
                  array("open" => "5:00 AM", "close" => "11:00 AM", "service" => "breakfast"),
                  array("open" => "11:30 PM", "close" => "2:00 PM", "service" => "lunch"),
              ),
               "Wednesday" => array(
                  array("open" => "5:00 AM", "close" => "11:00 AM", "service" => "breakfast"),
                  array("open" => "11:30 PM", "close" => "2:00 PM", "service" => "lunch"),
                  array("open" => "5:00 PM", "close" => "8:00 PM", "service" => "dinner"),
              ),
               "Thursday" => array(
                  array("open" => "5:00 AM", "close" => "11:00 AM", "service" => "breakfast"),
                  array("open" => "11:30 PM", "close" => "2:00 PM", "service" => "lunch"),
                  array("open" => "5:00 PM", "close" => "10:00 PM", "service" => "dinner"),
              ),
               "Friday" => array(
                  array("open" => "5:00 AM", "close" => "11:00 AM", "service" => "breakfast"),
                  array("open" => "11:30 PM", "close" => "2:00 PM", "service" => "lunch"),
                  array("open" => "5:00 PM", "close" => "11:30 PM", "service" => "dinner"),
              ), 
               "Saturday" => array(
                  array("open" => "11:30 PM", "close" => "2:00 PM", "service" => "lunch"),
                  array("open" => "4:00 PM", "close" => "11:30 PM", "service" => "dinner"),
              ), 
               "Sunday" => array (
                  array("open" => "10:00 AM", "close" => "2:00 PM", "service" => "Brunch buffet")
              ),
              "New Year's Day" => FALSE,
        );   

echo "<table><tr><th>Day</th><th>Status</th></tr>";
foreach ($days as $key => $value) {
   echo "<tr><td>$key</td>";
   if (is_array($value)) {
       echo "<td><table>";
       foreach ($value as $inner_key => $inner_value) {
           echo "<tr><td class='open'>We are OPEN at {$inner_value['open']} until {$inner_value['close']} for {$inner_value['service']}</td></tr>";      
       }   
       echo "</table></td>";
   } else if ($value) {
        echo "<td class='open'>We are OPEN 24 hours.</td>";
      } else {
        echo "<td class='closed'>Sorry, we are CLOSED.</td>";
      }
   echo "</tr>";
}
echo "</table>";
// -------------------------------------------------------------------------------------------------
?>
</body>
</html>
