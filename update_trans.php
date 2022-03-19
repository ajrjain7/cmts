<?php session_start();
if(!isset($_SESSION['_uname'])||$_SESSION['_uname']==null)
{ printf("<script>location.href='./login.php?desc=Login required'</script>");
}
include 'header.php';
require 'include/appdb_config.ini';

function show_last_sptrans($trans_id)
{
	try{			if($trans_id=="")return;
	
			$con1 = new mysqli(HOST, USER, PASSWORD, DATABASE);

			if(mysqli_connect_errno())	
			{
				die(' DB Connection Problem:' . mysqli_connect_error());
			}
			$firesql="select * from sp_trans_detail where trans_id=".$trans_id." order by sys_creation_date";
			$res=mysqli_query($con1,$firesql);
			echo '<table class="zebra">
			<thead>
			<tr><th width="8%">Trans ID</th>
			<th width="10%">Amt</th>
			<th width="25%">Comments</th>
			<th width="12%">Date of Payment (YYYY-mm-dd)</th>
			</thead>
			<tbody>
			';
			while($row=mysqli_fetch_array($res))
			{			
			$time=(float)(strtotime(date("d-m-Y"))-strtotime($row['date']))/86400;
			echo '<td>'.$row['trans_id'].'</td>';	
			echo '<td>'.$row['amt'].'</td>';	
			echo '<td>'.$row['comments'].'</td>';	
			echo '<td>'.$row['date'].'</td>';	
			echo '</tr>';
			}

			mysqli_close($con1);
		
	   }catch(Exception $s)
	   {
	   	echo '<option value="">Err in getting list</option>';
	   } 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/tablestyle.css" />
	<style>
	header{
	padding: 20px 30px 20px 30px;
	margin: 0px 20px 10px 20px;
	display: block;
    text-align: center;
}
#doner_list {
	position:absolute;
	width:224px;
	height:575px;
	z-index:1;
	left: 1112px;
	top: 157px;
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
				<h1>Update Sell-Purchase Detail</h1>
        
		<span id="desc" style="font-family:Georgia, 'Times New Roman', Times, serif"><?php echo $_GET['desc1'];?></span></header>       
      <div id="container">
      		<form id="updatecustform" action="jdbc/update_sptrans.php" method="post"> 
			<table width="10%" height="284" align="center" bgcolor="#B7BEDB" style="font-size:16px">
			<tr>
			<td width="15%">
    		Enter Trans ID* (Sale-Purchase): </td>
			<?php 
				  echo '<td width="20%"><input type="text" size="6" maxlength="6" style="font-size:16px" value='.$_GET['trans_id'].' id="trans_id" name="trans_id"></td>';	
			?>
			</tr>
			<tr>
			<td>Comments : </td>
			<td><input type="text" value="NA" id="comments" name="comments" size="42" maxlength="50" style="font-size:16px"></td>
			</tr>
			<tr>
			<td>Payment Amount*: </td>
			<td><input type="text" value="0" id="amt" name="amt" size="7" maxlength="7" style="font-size:16px"></td>		
			</tr><tr>
			<td>Date of Payment: </td>
<?php		echo '<td><input type="text" value='.date("d-m-Y").' id=dos name=dos size="10" maxlength="10" style="font-size:16px"></td>'; ?>
			</tr>
			<tr>
			<td></td><td>
	<input class="buttom" name="submit" id="submit" value=" Submit! " type="submit" style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:16px"></td>
	<td><input class="button" name="reset" id="reset" value=" RESET " type="RESET" style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:16px"></td>
			</tr> 	 
			</table>
   </form> 
<!--<div id="doner_list">
<strong>Customer List</strong><br />
<select id="cust_id" size="25"  style="border:hidden;font-size:16px;border-bottom:#000066;background-color:#CC99FF">
<option>ID NAME CITY</option>
		<?php
      	
        /*	try{  	require 'include/appdb_config.ini';
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
								echo '<option>'.$row['custid'].' - '.$row['city'].'- '.$row['surname'].' '.$row['cust_name'].'</option>';							
							}
							if($flag1!=0)echo '<h3>No Records Found</h3>';	
						}
	        }catch(Exception $e)
	         {
	          echo 'Message: ' .$e->getMessage();
				printf("<script>location.href='./error.php?errtype=2&errmsg=".$e->getMessage()."'</script>");
	   			 } 	
	  mysqli_close($con);*/
        	
        	?>				
   </select>
 
</div>-->
<hr>
Till Date Transaction Paid as: 
<?php show_last_sptrans($_GET['trans_id']);?>
</div>

</body>
</html>