<?php session_start();
if(!isset($_SESSION['_uname'])||$_SESSION['_uname']==null)
{ printf("<script>location.href='./login.php?desc=Login required'</script>");
}
include 'header.php';
require 'include/appdb_config.ini';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
table 				{
	color: #1B1B1B;
	padding: 5px;
	margin-top: 7px;
	margin-bottom: 7px;
}
td a, td a:visited	{
	color: #1B1B1B;
}

td  		{
	padding: 8px;
	text-align: left;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #E5E5E5;
}

.table_complete td	
{
	padding: 12px;
	text-align: left;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #E5E5E5;
}
	th 			{
	color: #333333;
	text-align: left;
	background-color: #EBEBEB;
	padding: 7px;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #999999;
	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #999;
}
#form1{
float:left;
}
</style>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</head>
	
<body>
<br />
			
			<form action="#" id="form1" method="post">
			
			<select name="drop" id="drop" class="textbox" align="left">
          <option value="" selected="selected">Select Filter</option>
          <option value="firm_id">Firm Id</option>
                  <option value="firm_name">Firm Name</option>
                  <option value="firm_type">Firm Type</option>
				  <option value="owner">Owner Name</option>
                  
                  
          </select>
          
          <input type="text" name="ser" id="ser" style="width:170px; border:1px solid;" />        
          
          <input type="submit" name="search" id="search" value="Search" />
          
          </form><br /><br />
      <div>
    		 
		  <?php include 'php/shwfirm.php';?>
</div>      
</div>
<?php include 'footer.html'?>
</body>
</html>
