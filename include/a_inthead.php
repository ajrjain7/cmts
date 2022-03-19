<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?php
session_start();

if(!isset($_SESSION['_username']) && !isset($_SESSION['admin_uname']))		//NO ONE LOGGED IN
{ printf("<script>location.href='../index.php?desc=Login Required'</script>");
}

        	
if(isset($_SESSION['_username'])||$_SESSION['_username']!=null)		//PLAYER EXIST
{ printf("<script>location.href='../user_home.php</script>");
}

if(!isset($_SESSION['user_type']) || ($_SESSION['admin_uname']==null))	//ADMIN NOT LOGGED IN
{ printf("<script>location.href='./alogin.php?desc=Login Required'</script>");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<header>
<div class="wrapper" align="right">
<a href="./admin_home.php"><img src="../images/company_logo.png" alt="Home logo" title="checkin and go home!" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			
<strong>Welcome <?php echo $_SESSION['admin_uname'];?></strong>&nbsp;
 - &nbsp;<a href="logout.php">Logout</a>
</div>
</header>	
</body>
</html>	
</body>
</html>
