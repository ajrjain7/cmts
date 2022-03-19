<?php session_start(); ?>
<html>
<head>
</head>
<body>
<h2><center>Please Wait... Removing User!!!</center></h2>
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
$user=mysqli_real_escape_string($con,$_POST['p_uname']);

if($user==null)
printf("<script>location.href='../handling_user.php?desc=<h3>Player not provided</h3>'</script>");

$check_uadmin="select _uadmin from members where _uname='". $user . "'";
$flag=0;
$res1=mysqli_query($con,$check_uadmin);
	while($row1=mysqli_fetch_array($res1))
	{
		$flag=1;
	} if($flag==0)
	 {	
		printf("<script>location.href='../handling_user.php?desc=<h3>You are not Authorized to delete other Admin's player</h3>'</script>");
	 }
	 
	$firesql="delete from open_bets where _uname='" .$user . "'";
	$firesql1="delete from history where _uname='" .$user . "'";
	$firesql2="delete from figures where _uname='" .$user . "'";
	$firesql3="delete from login_attempts where _uname='" .$user . "'";
	$firesql4="delete from members where _uname='" .$user . "'";
	$firesql5="update admin_act set total_deleted=total_deleted+1 where _uadmin='".$admin_uname . "'";

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
  
 if (!mysqli_query($con,$firesql4))
  { $flag=0;
	  die('Error: ' . mysqli_error($con));
  } 
  
  if (!mysqli_query($con,$firesql5))
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

