<?php

$day = preg_replace( '/[a-zA-Z]/', '', $_POST['Day']); 
$month = preg_replace( '/[^a-zA-Z]/', '', $_POST['Month']);
$year = preg_replace( '/[a-zA-Z]/', '', $_POST['Year']);
$hour = preg_replace( '/[a-zA-Z]/', '', $_POST['Hour']);
$minute = preg_replace( '/[a-zA-Z]/', '', $_POST['Minute']);
$ampm = preg_replace( '/[^a-zA-Z]/', '', $_POST['Am/Pm']);
?>


<!DOCTYPE html>
<html lang="en">
	<head>
	
	<title>Chapters 7&8</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width"/>
	
	</head>
	<body>
		form method="POST" action="Ch6Practice.php">
		<select name="Day"/>
		<?php
		for($x=0;$x<31;$x++)
		{
	  	echo "<option value=\"" .$x. "\">" .$x. "</option>\n";
		}
		?>
		<select name="Month"/>
		<?php
		<option value=\"" .$x. "\">" .$x. "</option>\n";
		?>
		<select name="Year"/>
		<?php
		for($x=1900;$x<date('Y');$x++)
		{
	  	echo "<option value=\"" .$x. "\">" .$x. "</option>\n";
		}
		?>
		<select name="Hour"/>
		<?php
		for($x=0;$x<24;$x++)
		{
	  	echo "<option value=\"" .$x. "\">" .$x. "</option>\n";
		}
		?>
		<select name="Minute"/>
		<select name="Am/PM"/>
	</body>	

</html>
