<?php
require 'AdminIndex.php';
$FormFilled=($_SERVER['REQUEST_METHOD']==='POST');
$ShowForm=True;
$blank="";

if($FormFilled==True)
{
 $username=preg_replace( '/[^a-zA-Z0-9]/', '',$_POST['username']);//preg_replace removes all special characters
 $password=preg_replace( '/[^a-zA-Z0-9]/', '',$_POST['password']);
 $ShowForm=False;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

	<title>Login Webpage</title>
	<meta charset='utf-8'/>
	<meta name='viewport' content='width=device-width'/>

</head>
<body>
	<?php
	if($FormFilled)
	{
	 if(Authorization($username,$password,$AdminUser,$AdminPass))
	  {
	    echo "<b>Welcome Administrator</b>"."</br>";
	    echo "</br>";
	  }
	 else
	  {
	    echo "Authorization Failed";
	    $ShowForm=True;
	  }
	$FormFilled=False;
	}
	?>
	
	<form method="POST" action="<?php echo ($_SERVER['PHP_SELF']);?>" >
	<?php
	if($ShowForm)
	{
	 echo "Username: "."<input type='text' name='username'>"."</br>";
	 echo "Password: "."<input type='text' name='password'>"."</br>";

	 echo "<input type=\"submit\" name=\"login\" value=\"Login\">";
	}
	?>
	</form>
	
	
	<?php
	if(Authorization($username,$password,$AdminUser,$AdminPass)) 
	{
	  echo "<a href='PHPCh13.php?username=$blank&password=$blank'>"."Log Out"."</a>";//Use blank variable to prevent showing of username and password in search bar
	  $ShowForm=True;
	}
	?>	

</body>

</html>
