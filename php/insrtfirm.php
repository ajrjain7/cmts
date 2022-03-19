<?php
require '../include/appdb_config.ini';
$con = new mysqli(HOST, USER, PASSWORD, DATABASE);
if(mysqli_connect_errno())	
{
die('Connection Problem: ' . mysqli_connect_error());
}
$sql= "insert into firms (firm_name, firm_type, owner, sys_creation_date) values('$_POST[firm_name]', '$_POST[firm_type]', '$_POST[owner]', NOW())";
if(!mysqli_query($con,$sql))
{
die('Error'.mysqli_connect_error());
}
//else{

//}//else{
printf("<script>location.href='../newfirm.php?msg=<h3>Firm Created Successfully</h3>'</script>");
//}
mysqli_close($con);
?>