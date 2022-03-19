<?php session_start();
if(!isset($_SESSION['_uname'])||$_SESSION['_uname']==null)
{ printf("<script>location.href='./login.php?desc=Login required'</script>");
}
if($_SESSION['auth_level']!=1)
{
printf("<script>location.href='./index.php?desc=Only Admin are authorized for Creation of User'</script>");
}
include 'header.php';
require 'include/appdb_config.ini';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript">
function validate_form()
{
	var user=document.getElementById("username").value;
	if(user.length<3)
	{
		alert("Username length must be more than 3");
		document.getElementById("username").value="";
		return false;
	}
	user=document.getElementById("password").value;
	if(user.length<5)
	{
		alert("Password length must be more than 5");
		document.getElementById("password").value="";
		return false;
	}
	return true;
}


</script>
<!--[if IE 6]>
<style>
body {behavior: url("csshover3.htc");}
#menu li .drop {background:url("img/drop.gif") no-repeat right 8px; 
</style>
<![endif]-->
	<style>
	header{
	padding: 20px 30px 20px 30px;
	margin: 0px 20px 10px 20px;
	display: block;
    text-align: center;
}
header h1{
	color: #498ea5;
	font-weight: 700;
	font-style: normal;
	font-size: 30px;
	padding: 0px 0px 5px 0px;
}
header h1 span{
	font-family: 'Alegreya SC', Georgia, serif;
	font-size: 20px;
	line-height: 20px;
	display: block;
	font-weight: 400;
	font-style: italic;
	color: #719dab;
	text-shadow: 1px 1px 1px rgba(0,0,0,0.1);
}
header h2{
	font-size: 16px;
	font-style: italic;
	color: #2d6277;
	text-shadow: 0px 1px 1px rgba(255,255,255,0.8);
}
</style>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</head>
	
<body><br />
			<header>
				<h1>Add New Sub-Admin</h1>
        </header>  
<center><?php echo $_GET['msg'];?></center>		
      <div  class="form">
    		<form id="contactform" action="php/insrtsubdomain.php" method="post" onsubmit="return validate_form()"> 
    			<p class="contact"><label for="username">Create a username</label></p> 
    			<input id="username" name="username" placeholder="username" required="" tabindex="1" type="text">
                
                <p class="contact"><label for="password">Create a password</label></p> 
    			<input type="password" id="password" name="password" placeholder="Enter Password" required="">
                
                <select class="select-style gender" name="authlevel" id="authlevel">
            <option value="select">Select Authrisation Level</option>
            <option value="1">Admin</option>
            <option value="2">Sub-Admin</option>
            </select><br><br> 
                
                <p class="contact"><label for="name">Full Name</label></p> 
    			<input id="name" name="name" placeholder="Enter Full Name" required="" required="" type="text">
                
                <p class="contact"><label for="phone">Mobile</label></p> 
    			<input id="mobile" name="mobile" placeholder="Enter Mobile Number" required="" type="text" maxlength="10"> 
    			  
        
               <p class="contact"><label for="phone">Address</label></p> 
    			<textarea name="address" id="address" rows="4" cols="63">NA</textarea>
  
            
            <p class="contact"><label for="surname">City</label></p> 
            <input id="city" name="city" placeholder="City" required="" type="text"> <br>
            <input class="buttom" name="submit" id="submit" value="Submit!" type="submit"> 	 
   </form> 
</div>      

  
</div>
<?php include 'footer.html';?>
</body>
</html>
