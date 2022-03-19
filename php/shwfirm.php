<?php
require './include/appdb_config.ini';
$con = new mysqli(HOST, USER, PASSWORD, DATABASE);
if(mysqli_connect_errno())	
{
die('Connection Problem: ' . mysqli_connect_error());
}
$sql="select * from firms ";
$where=false;
if(isset($_REQUEST['drop'])){$drop=$_REQUEST['drop'];
$ser=$_REQUEST['ser'];
if($ser!==NULL AND $ser!==''){if($where==false){$sql .=" where `".$drop."`='$ser'";
$where=true;}
else{}}}
$res=mysqli_query($con,$sql);
$row=$res;
echo "<table width='100%' border='0' cellpadding='0' cellspacing='0' class='table table-hover' id='groupstable'>
<tr><td><font size='3'><b>
Firm Id</b></font>
</td><td>
<font size='3'><b>Firm Name</b></font>
</td>
<td>
<font size='3'><b>Firm Type</b></font>
</td>
<td>
<font size='3'><b>Owner Name</b></font>
</td>
<td>
<font size='3'><b>Action</b></font>
</td>
</tr>";
while($row=mysqli_fetch_array($res))
{
  echo "<tr>";
  echo "<td><a href='#?anchor=". $row['firm_id'] ."' name='anchor' id='anchor'>" . $row['firm_id'] . "</a></td>"; 
  echo "<td><font size='2'>" . $row['firm_name'] . "</font></td>";
  echo "<td><font size='2'>" . $row['firm_type'] . "</font></td>";
  echo "<td><font size='2'>" . $row['owner'] . "</font></td>";
  echo "<td><a href='php/deletefirm.php?anchor=". $row['firm_id'] ."'> Delete</a></td>";
  echo "</tr>";
  }
echo "</table>";
mysqli_close($con);
?>