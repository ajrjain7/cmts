<?php session_start();
if(!isset($_SESSION['_uname'])||$_SESSION['_uname']==null)
{ printf("<script>location.href='./login.php?desc=Login required'</script>");
}
include 'header.php';
require 'include/appdb_config.ini';

function show_last_sptrans()
{
	try{
			$con1 = new mysqli(HOST, USER, PASSWORD, DATABASE);
			
			if(mysqli_connect_errno())	
			{
				die(' DB Connection Problem:' . mysqli_connect_error());
			}
			$firesql="select * from sp_transaction where trans_id in (select max(trans_id) from sp_transaction)";
			$res=mysqli_query($con1,$firesql);
			echo '<table class="zebra">
			<thead>
			<tr><th>Trans ID</th>
			<th>Cust ID</th>	
			<th>Firm</th>
			<th>Item Name</th>
			<th>Total Bill</th>
			<th>Principal Due</th>
			<th>Interest Amt Due</th>
			<th>Interest %</th>
			<th>Date of Sell</th>
			<th>Last Updated</th>
			</thead>
			<tbody>
			';
			while($row=mysqli_fetch_array($res))
			{
			
			$time=(float)(strtotime(date("d-m-Y"))-strtotime($row['date']))/86400;
			echo '<td>'.$row['trans_id'].'</td>';	
			echo '<td>'.$row['cust_id'].'</td>';	
			echo '<td>'.str_replace("_"," ",$row['firm_name']).'</td>';	
			echo '<td>'.$row['item_purchased'].'</td>';	
			echo '<td>'.$row['total_bill'].'</td>';	
			echo '<td>'.($row['total_bill']-$row['Paid']).'</td>';
			echo '<td>'.round((float)($row['Interest_Amt_Due']*(float)($time)*(float)$row['Interest'])/36500).'</td>';	//FORMULA TO CALCULATE INTEREST
			echo '<td>'.$row['Interest'].'</td>';	
			echo '<td>'.$row['date'].'</td>';	
			echo '<td>'.$row['sys_update'].'</td>';	
			}
			echo '</tr>';
			mysqli_close($con1);
		
	   }catch(Exception $s)
	   {
	   	echo '<option value="">Err in getting list</option>';
	   } 
}
function get_firmlist()
{
	try{
			$con1 = new mysqli(HOST, USER, PASSWORD, DATABASE);
			
			if(mysqli_connect_errno())	
			{
				die(' DB Connection Problem:' . mysqli_connect_error());
			}
			$firesql="select firm_name,firm_type from firms where firm_type='Sell_Purchase'";
			$res=mysqli_query($con1,$firesql);
			while($row=mysqli_fetch_array($res))
			{
				echo '<option value='.$row['firm_name'].'-'.$row['firm_type'].'>'.str_replace("_"," ",$row['firm_name']).'</option>';
			}
			
			mysqli_close($con1);
		
	   }catch(Exception $s)
	   {
	   	echo '<option value="">Err in getting list</option>';
	   } 
}

function get_cust_list()
{
	try{
			$con1 = new mysqli(HOST, USER, PASSWORD, DATABASE);
			
			if(mysqli_connect_errno())	
			{
				die(' DB Connection Problem:' . mysqli_connect_error());
			}
			$firesql="select * from cust_info";
			$res=mysqli_query($con1,$firesql);
			while($row=mysqli_fetch_array($res))
			{
				echo '<option value='.$row['custid'].'>'.$row['surname'].' '.$row['cust_name'].' S/o '.$row['cust_father'].', '.$row['city'].'</option>';
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
<script type="text/javascript" src="js/validation_trans.js">
</script>
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
				<h1>Add New Sell-Purchase Detail</h1>
        
		<span id="desc" style="font-family:Georgia, 'Times New Roman', Times, serif"><?php echo $_GET['desc1'];?></span></header>       
      <div id="container">
      		<form id="newcustform" action="jdbc/insert_newtrans.php" method="post" onsubmit="validate_sp()"> 
			<table width="25%" height="284" align="center" bgcolor="#B7BEDB" style="font-size:16px">
			<tr>
			<td width="16%">
    		Customer: &nbsp; </td>
			<td width="30%">
			<select id="custid" name="custid" onblur="check_custid()">
			<?php get_cust_list();?>
			</select>
			</td>
			
			<td width="12%">Select Firm </td><td>
			<select id="firm" name="firm" style="font-family:Arial, Helvetica, sans-serif;color:blue;font-size:18px">
			<?php get_firmlist();?>
			</select></td></tr>
			<tr>
			<td>
    		Item Purchased*: </td>
			<td><input type="text" value="" id="item_p" name="item_p" size="15" maxlength="20" style="font-size:16px"></td>
			<td>
Comments : </td>
			<td><input type="text" value="NA" id="comments" name="comments" size="42" maxlength="50" style="font-size:16px"></td>
			</tr>
			<tr><td>Total Bill*: </td>
			<td><input type="text" value="" id="total_bill" size="7" maxlength="7" name="total_bill" style="font-size:16px"></td></tr>
			<tr>
			<td>
    		Paid Amount*: </td>
			<td><input type="text" value="0" id="paid" name="paid" size="7" maxlength="7" style="font-size:16px"></td></tr>
			<tr>
			<td>
    		Interest Rate %:</td>
			<td><input type="text" value="0" id="net_bal" name="net_bal" size="7" maxlength="7" style="font-size:16px"></td>
			<td>Date of Sell: </td>
<?php		echo '<td><input type="text" value='.date("d-m-Y").' id="dos" name="dos" size="7" maxlength="7" style="font-size:16px"></td>'; ?>
			</tr>
			<tr>
			<td></td><td>
	<input class="buttom" name="submit" id="submit" value=" Submit! " type="submit" style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:16px">
	<img src="images/blank.png" id="process" name="process" alt="validate">
	</td>
	<td><input class="button" name="reset" id="reset" value=" RESET " type="RESET" style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:16px"></td>
			</tr> 	 
			</table>
   </form> 
<div id="doner_list">
<strong>Customer List</strong><br />
<select id="cust_id" size="25"  style="border:hidden;font-size:16px;border-bottom:#000066;background-color:#CC99FF">
<option>ID--> NAME--> CITY</option>
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
								echo '<option>'.$row['custid'].' - '.$row['city'].'- '.$row['surname'].' '.$row['cust_name'].'</option>';							
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
<hr>
Last Transaction added was: 
<?php show_last_sptrans();?>
</div>

</body>
</html>