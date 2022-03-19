<?php
require '../include/appdb_config.ini';
$con = new mysqli(HOST, USER, PASSWORD, DATABASE);
if(mysqli_connect_errno())	
{
die('Connection Problem: ' . mysqli_connect_error());
}
$sql="delete from firms where firm_id='$_GET[anchor]'";
if(!mysqli_query($con,$sql))
{
die('Error'.mysqli_error());
}
//else{
echo '<script language="javascript">document.location="../srchfirm.php"</script>';
//}//else{
//echo '<script language="javascript">document.location="enq2.php"</script>';
//}
mysql_close($con);
?>