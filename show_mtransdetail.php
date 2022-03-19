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
</head>
<body>
<p>INSTRUCTIONS: <br />
1. Click on "Add Entry" to make Payment entry for this Bill<br />
2. Dont Put two entry of Payment for same Date, only one time update allow per transaction id per day
</p>
<center>
<span id="desc1"><?php echo $_GET['desc1'];?></span>
<div id="container">
<?php 

if($_GET['custid']!="" && $_GET['trans_id']!="")
{
show_m_transaction($_GET['trans_id']);
show_detail_mtrans($_GET['trans_id']);
}
else '<h2>Invalid Cust/Trans ID</h2>';
//ELSE REDIRECT

function show_m_transaction($trans_id)
{
echo '>>>Customer ID: '.$_GET['custid'].'  >>>Trans ID: '.$trans_id.'
<h3>Mortgage Firm Transaction</h3>
<table class="" border=1 style="background-color:white;font-size:17px;text-align:center;color:black">
		<thead>
		<tr style="color:purple">
		<th width="15%">Trans-ID</th>
		<th width="15%">Firm</th>
		<th width="10%">Mortgage Item-Wt</th>
		
		<th width="10%">Principal Due</th>
		<th width="14%">Interest Amt Due</th>
		<th width="14%">Interest %</th>
		<th width="14%">Date of Purchase</th>
		<th width="14%">Comments</th>
		</tr>
		</thead>
		<tbody>		
';

try{ 	
			$con1 = new mysqli(HOST, USER, PASSWORD, DATABASE);		
			if(mysqli_connect_errno())	
			{
				die(' DB Connection Problem: ' . mysqli_connect_error());
			}						
			$city=mysqli_real_escape_string($con1,$cit);
			$custname=mysqli_real_escape_string($con1,$_POST['custname']);
			$surname=trim(substr($custname,0,strpos($custname,' ')));
			$custname=trim(substr($custname,strpos($custname,' ')));
					
			$firesql="select * from m_transaction where trans_id=".$_GET['trans_id']; //TAKE INNER JOIN OF CUST_INFO AND M_TRANSACTION
			$res=mysqli_query($con1,$firesql);
			while($row=mysqli_fetch_array($res))
			{
			$time=(float)(strtotime(date("d-m-Y"))-strtotime($row['till_date']))/86400;
			
echo '<tr><td>'.$row['trans_id'].'</td>';
echo '<td>'.$row['firm_name'].'</td>';
   echo '<td>'.$row['m_item'].' '.$row['m_item_wt'].'gms</td>';
   			//echo '<td>'.$row['exchange_amt'].'<hr>'.$row['till_date_return'].'</td>';		
				echo '<td style="color:red">'.($row['exchange_amt']-$row['till_date_return']).'</td>';		
				echo '<td style="color:red">'.($row['till_date_interest']+ round(($row['exchange_amt']-$row['till_date_return'])*(float)($time)*(float)$row['Interest']/36500)).'</td>';		
				echo '<td>'.$row['Interest'].'</td>';
				echo '<td>'.$row['sys_cre_date'].'</td>';
				echo '<td>'.$row['comments'].'</td>';
				echo '</td></tr>';				
			}	
			mysqli_close($con1);
	}catch(Exception $s)
	{
		echo $s->getMessage();
	}

echo '</tbody>
</table><br />
';
}

echo '<hr>';

function show_detail_mtrans($trans_id)
{
echo '
<h3>Detail</h3>
<table class="zebra">
		<thead>
		<tr>
		<th width="2%">Trans-ID</th>
		<th width="8%">Amount Deposited(Rs.)</th>		
		<th width="25%">Comments</th>
		<th width="10%">Date of Payment</th>
		</tr>
		</thead>
		<tbody>		
';

try{ 	
			$con1 = new mysqli(HOST, USER, PASSWORD, DATABASE);		
			if(mysqli_connect_errno())	
			{
				die(' DB Connection Problem: ' . mysqli_connect_error());
			}					
			$city=mysqli_real_escape_string($con1,$cit);
			$custname=mysqli_real_escape_string($con1,$_POST['custname']);
			$surname=trim(substr($custname,0,strpos($custname,' ')));
			$custname=trim(substr($custname,strpos($custname,' ')));
					
			$firesql="select * from m_trans_detail where trans_id=".$trans_id." order by sys_creation_dated"; //TAKE INNER JOIN OF CUST_INFO AND M_TRANSACTION
			$res=mysqli_query($con1,$firesql);
			while($row=mysqli_fetch_array($res))
			{				
				echo '<tr><td style="color:blue"><a href=./update_mtrans_detail?trans_id='.$row['trans_id'].'&date='.$row['date'].'>'.$row['trans_id'].'</a></td>';
				echo '<td>'.$row['amt'].'</td>';			
				echo '<td>'.$row['comments'].'</td>';	
				echo '<td>'.$row['date'].'</td>';			
				echo '</td></tr>';				
			}	
			mysqli_close($con1);
	}catch(Exception $s)
	{
		echo $s->getMessage();
	}

echo '</tbody>
</table>
<br />
<a href=./update_mtrans.php?trans_id='.$trans_id.'><input type="button" value="Add New Payment Entry" style="font-size:18px;font-family:BOLD">
';
}

?>
</div>
<br />
</center>
<?php include 'footer.html';?>
</body>
</html>