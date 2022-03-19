<?php
session_start();
if(isset($_SESSION['admin_uname']))
{
  unset($_SESSION['admin_uname']);
  unset($_SESSION['user_type']);
}  
session_destroy();

header("Location: ./login.php");
?>

<html>
<head>
<title>Logging out</title>
</head>
</html>