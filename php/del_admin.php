<?php session_start(); ?>
<html>
<head>
</head>
<body>
<h2><center>Please Wait... Removing Sub-Admin!!!</center></h2>
<?php
try{  	
		require '../include/sb_appdb_config.ini';
		require '../include/db_update_fn.php';
		$con = new mysqli(HOST, USER, PASSWORD, DATABASE);
		if(mysqli_connect_errno())	
		{
			die('Connection Problem: ' . mysqli_connect_error());
		}
$admin_uname=$_SESSION['admin_uname'];
$user=mysqli_real_escape_string($con,$_POST['a_uname']);

if($user==null)
printf("<script>location.href='../handling_user.php?desc=<h3>Player not provided</h3>'</script>");

$check_uadmin="select _uadmin, _uname from members where _uadmin='". $user . "'";
$flag=0;
$res1=mysqli_query($con,$check_uadmin);
	while($row1=mysqli_fetch_array($res1))
	{
		$flag=1;
	} if($flag==0)
	 {	
		printf("<script>location.href='../handling_user.php?desc=<h3>Sub-Admin/Admin does not exist</h3>'</script>");
	 }
	 
	$firesql="delete from admin_act where _uadmin='" .$user . "'";
	$firesql1="update members set _uadmin='".$admin_uname."' where _uadmin='" .$user . "'";
	$firesql2="delete from admin where _uadmin='" .$user . "'";
	$firesql3="update admin_act set total_deleted=total_deleted+1 where _uadmin='".$admin_uname . "'";

$flag=1;
if (!mysqli_query($con,$firesql))
  { $flag=0;
	  die('Error: ' . mysqli_error($con));
  }
if (!mysqli_query($con,$firesql1))
  { $flag=0;
	  die('Error: ' . mysqli_error($con));
  }

if (!mysqli_query($con,$firesql2))
  { $flag=0;
	  die('Error: ' . mysqli_error($con));
  }

if (!mysqli_query($con,$firesql3))
  { $flag=0;
	  die('Error: ' . mysqli_error($con));
  }
	mysqli_close($con);
	if($flag==0)
	echo'<h3><center>Deletion Failed, try later or contact customer_serivce</center></h3>';
	else
	{	
	echo'<h3><center>Player Removed Successfully</center></h3>';
	}

}catch(Exception $e)
 	  {   echo 'Message: ' .$e->getMessage();		 
		 printf("<script>location.href='../error.php?errtype=2&errmsg=".$e->getMessage()."'</script>");
	  }	 
?>
</body>
</html>

