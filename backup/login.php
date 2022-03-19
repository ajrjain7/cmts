<?php
session_start();
if($_SESSION['admin_uname']!=null && isset($_SESSION['admin_uname']))
{
printf("<script>location.href='./admin_home.php</script>");
}

?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Login here Admin/ Sub-admin </title>

    <link rel="stylesheet" href="css/admin_style.css" media="screen" type="text/css" />
	<script type="text/javascript">
	function val_form(thisform)
	{
		var u=document.getElementById("name").value;
		if((u!=null) && u.length>3)
		{	var pas=document.getElementById("pass").value;
			if((pas!=null) && pas.length>5)
			{ return true; }
			else 
			{ alert("Password is too short"); document.getElementById("pass").focus();
				return false;
			}
		}	
		else 
		{ alert("Invalid Username"); document.getElementById("name").focus();
			return false;
		}
		
	}	
	</script>
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>		
</head>

<body>


<span id="desc" name="desc" font="color:red"><center><?php echo $_REQUEST['desc']?></center></span>
<form name="adminlogin" id="adminlogin" action="php/authenticate.php" onSubmit="return val_form(this)" method="post">
<div id="logmsk" style="display: block;">
    <div id='close'>X</div>
    <div id="userbox">
        <h1 id="signup" style="background-color: rgb(118, 171, 219); background-position: initial initial; background-repeat: initial initial;">Sign up</h1>
        <div id="sumsk" style="display: none;">Sending</div>
        <input id="name" name="name" placeholder="ID" style="opacity: 1; background-color: rgb(255, 255, 255); background-position: initial initial; background-repeat: initial initial;">
        <input id="pass" name="pass" type="password" placeholder="Password" style="opacity: 1; background-color: rgb(255, 255, 255); background-position: initial initial; background-repeat: initial initial;">
        <p id="nameal" style="display: none; opacity: 1;">ID:</p>
        <p id="passal" style="display: none; opacity: 1;">Password:</p>
		<input type="submit" id="signupb" style="opacity: 1; cursor: default;" value="Sign In" name="signupb" />
		
    </div>
</div>
</form>
 
</body>

</html>