<?php

$AdminUser='admin';
$AdminPass='password';

function Authorization($User,$Pass,$AUser,$APass)
{
 if($User==$AUser && $Pass==$APass)
 {
  return(True);
 }
 elseif($User!=$AUser || $Pass!=$APass)
 {
  return(False);
 }
}

?>
