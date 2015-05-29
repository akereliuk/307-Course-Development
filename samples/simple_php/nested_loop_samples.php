<!DOCTYPE html>
<html>
<head>
<title>Nested Array Examples</title>
<style>
td {
 padding: 5px;
 border: 1px solid grey;
 text-align: center;
 width: 2em;
}

table {
	margin: 0px auto;
}
h1 {
	text-align: center;
}

div.fixed-width {
	float: left;
	width: 70px;
}

div.fixed-width div {
	width: 60px;
	text-align: center;
	float: left;
	border: 1px solid grey;
	margin: 1px;
	padding: 2px;
}
</style>
</head>
<body>
<h1>Sample Nested Loops</h1>
<?php

function cell ($data) {
	return "<td>$data</td>";
}

$limit = 15;
echo "<table>";
for ($row = 1; $row <= $limit; $row++) {
	$counter = 0;
	echo "<tr>";
	for ($col = 1; $col <= $limit; $col++) {
		echo cell($counter+$row);
		$counter += 15;
	}
	echo "</tr>";
}
echo "</table>";
?>
<h1>DIV vs TABLE</h1>
<table>
<tr><td>ONE</td><td>TWO</td><td>THREE</td></tr>
<tr><td>FOUR</td><td>FIVE</td><td>SIX</td></tr>
</table>

<div class="fixed-width">
<div>ONE</div>
<div>TWO</div>
<div>THREE</div>
</div>
<div class="fixed-width">
<div>FOUR</div>
<div>FIVE</div>
<div>SIX</div>
</div>
<br clear="all" />
<h1>Using div tags...</h1>
<?php
$limit = 15;
$counter = 1;
for ($row = 1; $row <= $limit; $row++) {
    echo "<div class='fixed-width'>";
	for ($col = 1; $col <= $limit; $col++) {
		echo "<div>$counter</div>";
		$counter++;
	}
	echo "</div>";
}
?>


</body>
</html>
</html>