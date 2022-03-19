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

  <title>CMTS Login Form</title>
  
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

    <style>
@import url(http://fonts.googleapis.com/css?family=Exo:100,200,400);
@import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:700,400,300);

body{
	margin: 0;
	padding: 0;
	background: #fff;

	color: #fff;
	font-family: Arial;
	font-size: 12px;
}

.body{
	position: absolute;
	top: -20px;
	left: -20px;
	right: -40px;
	bottom: -40px;
	width: auto;
	height: auto;
	background-image: url(http://ginva.com/wp-content/uploads/2012/07/city-skyline-wallpapers-008.jpg);
	background-size: cover;
	-webkit-filter: blur(5px);
	z-index: 0;
}
#Layer1 {
	position:absolute;
	width:1131px;
	height:77px;
	z-index:1;
	top: 608px;
}
.grad{
	position: absolute;
	top: -20px;
	left: -20px;
	right: -40px;
	bottom: -40px;
	width: auto;
	height: auto;
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
	z-index: 1;
	opacity: 0.7;
}

.header{
	position: absolute;
	top: calc(50% - 35px);
	left: calc(50% - 255px);
	z-index: 2;
}

.header div{
	float: left;
	color: #fff;
	font-family: 'Exo', sans-serif;
	font-size: 35px;
	font-weight: 200;
}

.header div span{
	color: #5379fa !important;
}

.login{
	position: absolute;
	top: calc(50% - 75px);
	left: calc(50% - 50px);
	height: 150px;
	width: 350px;
	padding: 10px;
	z-index: 2;
}

.login input[type=text]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	color: #fff;
	font-family: 'Exo', sans-serif;
	font-size: 16px;
	font-weight: 400;
	padding: 4px;
}

.login input[type=password]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	color: #fff;
	font-family: 'Exo', sans-serif;
	font-size: 16px;
	font-weight: 400;
	padding: 4px;
	margin-top: 10px;
}

.login input[type=submit]{
	width: 260px;
	height: 35px;
	background: #fff;
	border: 1px solid #fff;
	cursor: pointer;
	border-radius: 2px;
	color: #a18d6c;
	font-family: 'Exo', sans-serif;
	font-size: 16px;
	font-weight: 400;
	padding: 6px;
	margin-top: 10px;
}

.login input[type=submit]:hover{
	opacity: 0.8;
}

.login input[type=submit]:active{
	opacity: 0.6;
}

.login input[type=text]:focus{
	outline: none;
	border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=password]:focus{
	outline: none;
	border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=submit]:focus{
	outline: none;
}

::-webkit-input-placeholder{
   color: rgba(255,255,255,0.6);
}

::-moz-input-placeholder{
   color: rgba(255,255,255,0.6);
}
#Layer1 {
	position:absolute;
	width:1131px;
	height:77px;
	z-index:1;
	top: 473px;
	left: 10px;
}
    #Layer2 {
	position:absolute;
	width:342px;
	height:357px;
	z-index:3;
	left: 13px;
	top: 101px;
}
    </style>

    <script src="js/prefixfree.min.js"></script>
</head>

<body>

  <div class="body"></div>
		<div class="grad"></div>
		<div id="Layer2">
		<iframe scrolling="noscroll" src="http://goldiraguide.org/chart/widget/chart-tabs.php?metal=gold&graph_width=228&graph_height=160&color_dark=919191&color_light=ffffff&color_graph=0117b2" width="250" height="335" frameborder="0" style="float: left;"></iframe><div style="display: block; margin-top: -22px !important; width: 250px; padding: 0px 0px 0px 0px; float: left; margin: 0px; font-size: 11px; clear: left;"></div>
		
		</div>
		<div class="header">
			<div><b>CMTS</b><span><b>Log In</b></span></div>
		</div>
		<div id="Layer1">
          <iframe style='width:1160px; height:160px' MARGINWIDTH='0' MARGINHEIGHT='0' HSPACE='0' VSPACE='0' FRAMEBORDER='0' SCROLLING='no' align='left' valign='top' id='mailroifrm' ALLOWTRANSPARENCY='true' src='http://www.finalaya.com/Widget/MarketTicker.aspx?Theme=blue'></iframe>
</div>
		<br>
<form name="adminlogin" id="adminlogin" action="php/authenticate.php" onSubmit="return val_form(this)" method="post">

<div class="login">
				<input type="text" placeholder="username" name="name" id="name"><br>
				<input type="password" placeholder="password" name="pass" id="pass"><br>
				<input type="submit" id="signupb" name="signupb" value="Login"><br>Copyright &copy; 2014 cmts.kaizensoftnet.com, Powered by Kaizensoft
  </div>
<br />
<br />
</form>
  <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>

</body>

</html>