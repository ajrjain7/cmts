<?php 			  session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Authenticating...</title>
</head>

<body>
<center><h3>Please Wait...</h3></center>
<input type="hidden" id="desc" value="Invalid User name or Password" />
<?php
try{
		include_once '../include/appdb_config.ini';   // As functions.php is not included
		$con = new mysqli(HOST, USER, PASSWORD, DATABASE);

		$user=$_POST["name"];
		
		$user = mysqli_real_escape_string($con,$user);
		$pass=mysqli_real_escape_string($con,$_POST["pass"]);
		$pass=sha1($pass);
		if(mysqli_connect_errno())	
		{
			die(' DB Connection Problem: ' . mysqli_connect_error());
		}
		else
		{   $flag=0;
		   $result = mysqli_query($con,"select _uname, auth_level,full_name from sec_user where _uname='".$user."' and _password='".$pass."'"); 
			$pass="";
		   while($row = mysqli_fetch_array($result))
		   {   $flag=1;
				
			  $_SESSION['_uname']=$row['_uname'];
			  $_SESSION['auth_level']=$row['auth_level'];
			  if($_SESSION['_uname']==null)
			  {
			   printf("<script>location.href='../login.php?desc=Problem in saving session try later'</script>");
			  }
			  else
			   {	
			   $ip=getIp();
			   if($ip!=null)
			   $_SESSION['your_ip']=$ip;
			   echo 'Your IP is: '.$ip;
				printf("<script>location.href='../index.php'</script>");
				}	
		   }		   
		   mysqli_close($con);				   
		   if($flag==0)
		   { 		   
		   	 echo $flag;
		  	 printf("<script>location.href='../login.php?desc=Invalid User name or Password'</script>");
			}									   // REDIRECT TO LOGIN PAGE
	
	  }										//ELSE END
	}catch(Exception $e)
 	  {   
 		  printf("<script>location.href='./error.php?errtype=2&errmsg=".$e->getMessage()."'</script>");
	  }	     

function getIp() {
   $ip = $_SERVER['REMOTE_ADDR'];    
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}

?>

</body>
</html>
