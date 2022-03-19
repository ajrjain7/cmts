<?php session_start(); ?>
<html>
<head>
</head>
<body>
<h2><center>Please Wait... Updating!!!</center></h2>
<?php
try{  	
		require '../include/sb_appdb_config.ini';
		require '../include/db_update_fn.php';
		$con = new mysqli(HOST, USER, PASSWORD, DATABASE);
		if(mysqli_connect_errno())	
		{
			die('Connection Problem: ' . mysqli_connect_error());
		}

$fname=mysqli_real_escape_string($con,$_POST['fname']);
$mobile_no=mysqli_real_escape_string($con,$_POST['mobile_no']);
$user=mysqli_real_escape_string($con,$_POST['un']);
if($user==null)
printf("<script>location.href='../handling_admin.php?desc=<h3>User-id not provided</h3>'</script>");
 
	$firesql="UPDATE admin SET Name='".$fname."', Mobile_no='".$mobile_no."' WHERE _uadmin='".$user."'";

if (!mysqli_query($con,$firesql))
  { $flag=0;
	  die('Error: ' . mysqli_error($con));
  }
	mysqli_close($con);
printf("<script>location.href='../handling_admin.php?desc=<h3>Updated profile</h3>'</script>");	
}catch(Exception $e)
 	  {   echo 'Message: ' .$e->getMessage();		 
		 printf("<script>location.href='../error.php?errtype=2&errmsg=".$e->getMessage()."'</script>");
	  }	 
?>
</body>
</html>

