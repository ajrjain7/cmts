<?php session_start();
if(!isset($_SESSION['_uname'])||$_SESSION['_uname']==null)
{ printf("<script>location.href='./login.php?desc=Login required'</script>");
}
include 'header.php';
require 'include/appdb_config.ini';
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/tablestyle.css" />	
	<script type="text/javascript" src="./js/validate_fun.js">	
	</script>
	<script type="text/javascript">
function val_form()
{	var flag=1;
	var numpattern=/^[a-zA-Z._ ()]+$/;      
	var field=document.getElementById("city");
	if(field.value==""||!field.value.match(numpattern))
	{
		field.value="NA";
	}
	field=document.getElementById("custname");	
	if(field.value==""||!field.value.match(numpattern))
	{	alert("Invalid Customer Name");
		return false;
	}
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
	
<body>
			<br /><br />
			<header>
				<h1 align="center">Add New Firm</h1>
        </header> 
<!--<center><?php echo $_GET['msg'];?></center>-->	
      <div  class="form">
    		<form id="contactform" action="php/insrtfirm.php" method="post"> 
    			<p class="contact"><label for="name">Firm Name</label></p> 
    			<input id="firm_name" name="firm_name" placeholder="Enter Full Name" required="" tabindex="1" type="text"> 
    			  
        
               <select class="select-style gender" name="firm_type" id="firm_type">
            <option value="select">Select Firm Type</option>
            <option value="Mortgage">Mortgage</option>
            <option value="Sell/Purchase">Sell / Purchase</option>
            </select>
  
           <br><br>
            
            <p class="contact"><label for="owner">Owner Name</label></p> 
            <input id="owner" name="owner" placeholder="Enter Full Name" required="" type="text"> <br>
            <input class="buttom" name="submit" id="submit" tabindex="5" value="Submit!" type="submit"> 	 
   </form> 
</div>      

  
</div>
<div id="fot">
  <div id="fotlinks1">
    <div id="fotlinks4">
      <h2>My Firms</h2>
      <br />
      <a href="newfirm.php">Add New Firm</a><br />
      <a href="#">Delete Firm</a><br />
      <a href="#">Search Firm</a><br />
      </div>
    <div id="fotlinks3">
      <div id="fotlinks5">
        <h2>My Customers</h2>
        <br />
        <a href="newcustomer.php">Add New Customer</a><br />
        <a href="#">Delete Customer</a><br />
        <a href="#">Search Customer</a><br />
        </div>
    </div>
    <div id="fotlinks2">
      <h2>Sub - Admins</h2>
      <br />
      <a href="newsubadmin.php">Add New Sub-Admin</a><br />
      <a href="#">Delete Sub-Admin</a><br />
    </div>
  </div>
</div>
<div id="fotlinks6">
  <div align="center">Copyright 2014 cmts.kaizensoftnet.com<br />
Thanks to <a href="http://www.kaizensoftnet.com/">Kaizen Software</a></div>
</div>
</body>
</html>
