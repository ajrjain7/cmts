<?php session_start();
if(!isset($_SESSION['_uname'])||$_SESSION['_uname']==null)
{ printf("<script>location.href='./login.php?desc=Login required'</script>");
}
include 'header.php';
require 'include/appdb_config.ini';

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

function show_last_mtrans()
{
	try{
			$con1 = new mysqli(HOST, USER, PASSWORD, DATABASE);
			
			if(mysqli_connect_errno())	
			{
				die(' DB Connection Problem:' . mysqli_connect_error());
			}
			$firesql="select * from m_transaction where trans_id in (select max(trans_id) from m_transaction)";
			$res=mysqli_query($con1,$firesql);
			echo '<table class="zebra">
			<thead>
			<tr><th>Trans ID</th>
			<th>Customer ID</th>
			<th>Firm</th>
			<th>Mortgage Item/wt </th>
			<th>Equivalent Amt</th>
			<th>Interest %</th>
			<th>Amount Due</th>
			<th>Till-Date Interest</th>
			<th>Date Placed</th>
			</thead>
			<tbody>
			';
			while($row=mysqli_fetch_array($res))
			{
			echo '<td>'.$row['trans_id'].'</td>';	
			echo '<td>'.$row['custid'].'</td>';	
			echo '<td>'.$row['firm_name'].'</td>';	
			echo '<td>'.$row['m_item'].'/'.$row['m_item_wt'].'</td>';	
			echo '<td>'.$row['exchange_amt'].'</td>';	
			echo '<td>'.$row['Interest'].'</td>';	
			echo '<td>'.$row['net_due_amt'].'</td>';	
			echo '<td>'.$row['till_date_interest'].'</td>';	
			echo '<td>'.$row['sys_cre_date'].'</td>';	
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
			$firesql="select firm_name,firm_type from firms where firm_type='Mortgage'";
			$res=mysqli_query($con1,$firesql);
			while($row=mysqli_fetch_array($res))
			{
				echo '<option value='.$row['firm_name'].'-'.$row['firm_type'].'>'.$row['firm_name'].'</option>';
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
header h1{
	color: #498ea5;
	font-weight: 700;
	font-style: normal;
	font-size: 30px;
	padding: 0px 0px 5px 0px;
}
#doner_list {
	position:absolute;
	width:224px;
	height:575px;
	z-index:1;
	left: 1112px;
	top: 157px;
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
				<h1>Add New Mortgage Detail</h1>
        
		<span id="desc" style="font-family:Georgia, 'Times New Roman', Times, serif"><?php echo $_GET['desc1'];?></span></header>       
      <div id="container">
      		<form id="newcustform" action="jdbc/insert_newmtrans.php" method="post" onsubmit="validate_m()"> 
			<table width="25%" height="284" align="center" bgcolor="#B7BEDB" style="font-size:16px">
			<tr>
			<td width="16%">
    		Customer *: &nbsp; </td>
			<td width="25%">
			
			<select id="custid" name="custid" onblur="check_custid()">
			<?php get_cust_list();?>
			
			</td>
			
			<td width="16%">Select Firm </td><td>
			<select id="firm" name="firm" style="font-family:Arial, Helvetica, sans-serif;color:blue;font-size:18px">
			<?php get_firmlist();?>
			</select></td></tr>
			<tr>
			<td>
    		Mortagage Item *: </td>
			<td><input type="text" value="" id="item_p" name="item_p" size="25" maxlength="30" style="font-size:16px"></td>
			<td>Item Weight(in gms)</td>
			<td><input type="text" value="" id="item_wt" name="item_wt" size="10" maxlength="20" style="font-size:16px"></td>
			</tr>
			<tr><td>Equivalent Amt*: </td>
			<td><input type="text" value="" id="exchange_amt" size="7" maxlength="7" name="exchange_amt" style="font-size:16px"></td></tr>
			<tr>
			<td>
    		Interest Rate %: </td>
			<td><input type="text" value="0" id="interest" name="interest" size="7" maxlength="7" style="font-size:16px"></td></tr>
			<tr>
			<td>Net Balance: 
    		</td>
			<td><input type="text" value="0" id="net_bal" name="net_bal" size="7" maxlength="7" style="font-size:16px"></td>
			<td>Date of Interest Start: </td>
<?php		echo '<td><input type="text" value='.date("d-m-Y").' id="dos" name="dos" size="7" maxlength="7" style="font-size:16px"></td>'; ?>
			</tr>
			<tr>			<td>
Comments : </td>
			<td><input type="text" value="NA" id="comments" name="comments" size="42" maxlength="50" style="font-size:16px"></td>
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
<?php show_last_mtrans();?>
</div>

</body>
</html>