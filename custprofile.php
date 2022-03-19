<?php session_start();
if(!isset($_SESSION['_uname'])||$_SESSION['_uname']==null)
{ printf("<script>location.href='./login.php?desc=Login required'</script>");
}
include 'header.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript">
function show_profile()
{
	var c1=document.getElementById("cust_id").value;
	if(c1=="")return;
	document.getElementById("process").src="./images/loading.gif";
		xmlhttp=new XMLHttpRequest();	
		xmlhttp.onreadystatechange=function()
	  	{
	  if(xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
		    document.getElementById("container").innerHTML=xmlhttp.responseText;
			document.getElementById("process").src="./images/blank.png";
	    }
	  	}
	xmlhttp.open("POST","./php/get_custdetail.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("custid="+c1);	
	
}

</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<style>
	header{
	padding: 20px 30px 20px 30px;
	margin: 0px 20px 10px 20px;
	display: block;
    text-align: center;
}
#doner_list {
	position:absolute;
	width:283px;
	height:875px;
	z-index:1;
	left: 976px;
	top: 262px;
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
</head>
<body>
<br />
			<header>
				<h1>Customer Profile</h1>
        </header>       
		<center><span id="desc" style="font-family:Georgia, 'Times New Roman', Times, serif">
		<img src="images/blank.png" id="process" name="process">
		<?php echo $_GET['desc1'];?></span></center>
      	<div id="container">      		
</div>
 <div id="doner_list">
<strong>Customer List</strong><br />
	<select id="cust_id" name="cust_id" size="25"  style="border:hidden;font-size:16px;border-bottom:#000066;background-color:#CC99FF" onchange="show_profile()">
<option value="">ID--> NAME--> CITY</option>
		<?php
      	
        	try{  	require 'include/appdb_config.ini';
							$con = new mysqli(HOST, USER, PASSWORD, DATABASE);
					
						if(mysqli_connect_errno())	
						{
							die(' DB Connection Problem: ' . mysqli_connect_error());
						}
						else
						{ 
							$firesql="select custid, cust_name,city, surname from cust_info order by city";			
							   $result1 = mysqli_query($con,$firesql); 
							 $flag1=1;					
		    				while($row=mysqli_fetch_array($result1))
		   					{	$flag1=0;								
								echo '<option value='.$row['custid'].'>'.$row['custid'].' - '.$row['city'].'- '.$row['surname'].' '.$row['cust_name'].'</option>';							
							}
							if($flag1!=0)echo '<h3>No Records Found</h3>';	
						}
	        }catch(Exception $e)
	         {
	          echo 'Message: ' .$e->getMessage();
				printf("<script>location.href='./error.php?errtype=2&errmsg=".$e->getMessage()."'</script>");
	   		 } 	
	  mysqli_close($con);
        	
        	?>				
   </select>
 
</div>

</body>
</html>
