<?php
	require_once("Student.php");
	require_once("Grades.php");

	$students = array(
		new student("Kevin", "Slonka", "1001", array("CPSC222" => 98, "MATH241" => 76, "ENGL101" => 82)),
		new student("John", "Doe",   "1002", array("CPSC222" => 88, "MATH241" => 46, "ENGL101" => 72)),
		new student("Tyler",  "Jones", "1003", array("CPSC222" => 68, "MATH241" => 96, "ENGL101" => 82))
	);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Student Grades</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width" />
		<!--<linkrel="stylesheet" src="styles.css" /> -->
	</head>
	<body>
		<h1>Student Grades</h1>

<?php
	for($i = 0; $i < count($students); $i++)
		{
		echo "<h2>" . $students[$i]->getLastName() . ", " . $students[$i]->getFirstName() . "</h2>";
		echo "<table border=1>";
		echo "<tr>";
			echo "<th>Student ID</th>";
			echo "<th>Name</th>";
			echo "<th>Courses</th>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>" . $students[$i]->getStudentId() . "</td>";
			echo "<td>" . $students[$i]->getLastName() . ", " . $students[$i]->getFirstName() . "</td>";
			echo "<td><ul>";
			foreach($students[$i]->getCourses() as $course => $grade)
				{
				echo "<li>" . $course . " - " . $grade . "% " . getLetterGrade($grade) . "</li>";
				}
			echo "</ul></td>";
		echo "</tr>";
		echo "</table>";
		echo "<br/>";
		}
?>

	</body>
</html>
