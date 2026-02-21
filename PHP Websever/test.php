<?php
$serername = "localhost";
$username = "root";
$password = "P@ssw0rd!";

//create connecton
$conn= new mysqli($servername,$username,$password);

//Check connection
if ($conn->connect_error) {
  die("Connection Failed" . $conn->connect_error);
}
echo "Connected Successfully";
?>
