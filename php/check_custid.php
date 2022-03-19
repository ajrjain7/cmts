<?php session_start();
if(!isset($_SESSION['_uname'])||$_SESSION['_uname']==null)
{ printf("<script>location.href='../login.php?desc=Login required'</script>");
}
require '../include/appdb_config.ini';
$custid=$_POST['custid'];
if($custid=="")
{echo '<em style="color:red">Invalid Customer ID</em>';}
else
{
check_custid($custid);
}

function check_custid($custid)
{
	try{	
	$con1 = new mysqli(HOST, USER, PASSWORD, DATABASE);			
			if(mysqli_connect_errno())	
			{
				die(' DB Connection Problem:' . mysqli_connect_error());
			}
			$firesql="select * from cust_info where custid=".$custid;
			$res=mysqli_query($con1,$firesql);
			$flag=0;
			if($row1=mysqli_fetch_array($res))
			{
	 			$flag=1;
				echo '<h3 align="center" style="color:blue">Customer: '.$row1['cust_name'].' '.$row1['surname'].' '.$row1['city'].'</h3>';
			}
			if($flag==0)
			echo '<h3 align="center" style="color:red">Customer ID Does Not Exist</h3>';						
			
	}catch(Exception $s)
	{
		echo 'Err in Checking Customer ID '.$s->getMessage();
	}
}

?>