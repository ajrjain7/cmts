<?php
require '../include/appdb_config.ini';
$con = new mysqli(HOST, USER, PASSWORD, DATABASE);
if(mysqli_connect_errno())	
{
die('Connection Problem: ' . mysqli_connect_error());
}
$uname=$_POST['username'];
$pass=sha1($_POST['password']);
$auth_level=$_POST['auth_level'];

$sql= "insert into sec_user (_uname, _password, auth_level, full_name, mobile, address, city, sys_creation_date) values('".$_POST[username]."', '".$pass."', '".$_POST[authlevel]."', '".$_POST[name]."', '".$_POST[mobile]."', '".$_POST[address]."', '".$_POST[city]."', NOW())";
if(!mysqli_query($con,$sql))
{
die('Error'.mysqli_connect_error());
}
//else{

//}//else{
if($auth_level==1)
printf("<script>location.href='../newsubadmin.php?msg=<h3><em style=color:green>Admin User Created Successfully</h3>'</em></script>");
else if($auth_level==2)
printf("<script>location.href='../newsubadmin.php?msg=<h3><em style=color:green>Sub-Admin User Created Successfully</em></h3>'</script>");

//}
mysqli_close($con);
?>