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
$lname=mysqli_real_escape_string($con,$_POST['lname']);
$city=mysqli_real_escape_string($con,$_POST['city']);
$country=mysqli_real_escape_string($con,$_POST['country']);
$cur_bal=mysqli_real_escape_string($con,$_POST['cur_bal']);
$mobile_no=mysqli_real_escape_string($con,$_POST['mobile_no']);
$under_admin=mysqli_real_escape_string($con,$_POST['under_admin']);
$user=mysqli_real_escape_string($con,$_POST['un']);
if($user==null)
printf("<script>location.href='../handling_user.php?desc=<h3>Player not provided</h3>'</script>");

$check_uadmin="select _uadmin from admin where _uadmin='". $under_admin . "'";
$flag=0;
$res1=mysqli_query($con,$check_uadmin);
	while($row1=mysqli_fetch_array($res1))
	{
		$flag=1;
	} if($flag==0)
	 {	
		printf("<script>location.href='../handling_user.php?desc=<h3>Invalid Admin/Sub-Admin Name provided</h3>'</script>");
	 }
	 
	$firesql="UPDATE members SET fname='".$fname."', lname='".$lname."', city='".$city."',country='".$country."',mobile='".$mobile_no."' ,_uadmin='".		$under_admin."' WHERE _uname='".$user."'";

//mysqli_query($con,$firesql);

//INSERT INTO `employee_detail` (`emp_id`, `first_name`, `last_name`, `jobrole`, `skills`, `sex`, `age`, `mobile_no`, `city`, `DOB`, `prof_pic_path`, `linkedin`, `company`, `sys_creation_date`) VALUES 
//(1, 'Anshul', 'Jain', 'Java Developer', 'java, mysql', 'M', 23, 919028525780, 'Pune', '1990-09-19', 'anshulj.png', NULL, 'kaizensoft', '2014-02-25 00:26:19')


if (!mysqli_query($con,$firesql))
  { $flag=0;
	  die('Error: ' . mysqli_error($con));
  }
	mysqli_close($con);
if(update_usercredit($user,$cur_bal)==0)
{	
	printf("<script>location.href='../handling_user.php?desc=<h3>Not Updated/Credited Successfully, Try later</h3>'</script>");
}else
	{	
	printf("<script>location.href='../handling_user.php?desc=<h3>Updated/Credited Successfully</h3>'</script>");
	}

}catch(Exception $e)
 	  {   echo 'Message: ' .$e->getMessage();		 
		 printf("<script>location.href='../error.php?errtype=2&errmsg=".$e->getMessage()."'</script>");
	  }	 
?>
</body>
</html>

