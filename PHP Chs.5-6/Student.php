<?php
class student
	{
	private $firstName = '', $lastName = '', $studentId = '', $courses = array();

	function __construct($fn, $ln, $id, $c)//two underscores before constructor
		{
		$this -> setFirstName($fn);
		$this -> setLastName($ln);
		$this -> setStudentId($id);
		$this -> setCourses($c);
		}

	function setFirstName($fn)
		{$this->firstName = $fn;}
	function setLastName($ln)
		{$this->lastName = $ln;}
	function setStudentId($id)
		{$this->studentId = $id;}
	function setCourses($c)
		{$this->courses = $c;}
	function getFirstName()
		{return $this->firstName;}
	function getLastName()
		{return $this->lastName;}
	function getStudentId()
		{return $this->studentId;}
	function getCourses()
		{return $this->courses;}
	}
?>
