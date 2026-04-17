<?php

$monthconvert = array("January"=>1,"Febuary"=>2,"March"=>3,"April"=>4,"May"=>5,"June"=>6,"July"=>7,"August"=>8,"September"=>9,"October"=>10,"November"=>11,"December"=>12);
$LinkClicked = isset($_GET['month']);
$FormFilled - ($_SERVER['REQUEST_METHOD']=== 'POST');

if(FormFilled==True)
{
$month= $_POST['month'];
$month= $_POST['day'];
$month= $_POST['year'];
$month= $_POST['hour'];
$month= $_POST['minute'];
$month= $_POST['ampm'];
}

if($LinkClick==True)
{
$day = preg_replace( '/[a-zA-Z]/', '', $_POST['Day']); 
$month = preg_replace( '/[^a-zA-Z]/', '', $_POST['Month']);
$year = preg_replace( '/[a-zA-Z]/', '', $_POST['Year']);
$hour = preg_replace( '/[a-zA-Z]/', '', $_POST['Hour']);
$minute = preg_replace( '/[a-zA-Z]/', '', $_POST['Minute']);
$ampm = preg_replace( '/[^a-zA-Z]/', '', $_POST['AM/PM']);
}

function FancyPrint ($month, $day, $year, $hour, $minute, $ampm)
{
 return(date("l F jS, y - g:ia",mktime($hour, $min, 0, $month, $day, $year));
}
function IsoPrinter ($month, $day, $year, $hour, $minute, $ampm)
{
 return(date("c, mktime($hour, $min, 0, $month, $day, $year));
}




?>


<!DOCTYPE html>
<html lang="en">
	<head>
	
	<title>Chapters 7&8</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width"/>
	
	</head>
	<body>
		<h>Birthday Formatter</h>
		<form method="POST" action="<?php echo ($_SERVER['PHP_SELF']); ?>">
		<table border=2>
		<tr>
		<th>Month</th>
		<th>Day</th>
		<th>Year</th>
		<th>Hour</th>
		<th>Minute</th>
		<th>AM/PM</th>
		</tr>
		
		<tr>
		<th>
		<select name="Month">
		<?php
		foreach($monthconvert as $name=> $num) 
		{
		 echo "<option value=".$num."> ".$name."</options>";
		}
		</select>
		</th>
		<th>
		<select name="Day">
		<?php
		for($x=1;$x<31;$x++)
		{
	  	echo "<option value=\"" .$x. "\">" .$x. "</option>\n";
		}
		?>
		</select>
		</th>
		<th>
		<select name="Year">
		<?php
		for($x=1900;$x<date('Y');$x++)
		{
	  	echo "<option value=\"" .$x. "\">" .$x. "</option>\n";
		}
		?>
		</select>
		</th>
		<th>
		<select name="Hour">
		<?php
		for($x=1;$x<12;$x++)
		{
	  	echo "<option value=\"" .$x. "\">" .$x. "</option>\n";
		}
		?>
		</select>
		</th>
		<th>
		<select name="Minute">
		<?php
		for($x=0;$x<60;$x++)
		{
	  	echo "<option value=\"" .$x. "\">" .$x. "</option>\n";
		}
		?>
		</select>
		</th>
		<th>
		<select name="AM/PM">
		<?php
		echo "<option value=\"AM"\">""</option>\n";
		echo "<option value=\"PM"\">""</option>\n";
		?>
		</select>
		</th>
		</table>
		
		</br>
		
		<input type="submit" name="submit" value="Click To Submit">
		
		</form>
		
		<?php if(FormFilled==True)
		{
		 echo FancyPrint(date($hour, $minute, $month, $day, $year, $ampm) 
		 echo "<a href='PHPCH78.php?month=$month&day=$day,year=$year,hour=$hour,minute=$minute,ampm=$ampm'>"."Show ISO"."</a>"
		 $FormFilled=False;
		}?>
		
	</body>	
</html>
