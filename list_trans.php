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
<center>
<span id="desc1"><?php echo $_GET['desc1'];?></span>
<div id="container">
<?php 


show_sp_transaction();

show_m_transaction();

//ELSE REDIRECT

function show_sp_transaction($custid)
{
echo '
<h3>Sale Purchase Firms Brief</h3>
<table class="zebra">
		<thead>
		<tr>
		<th width="10%">Item</th>
		<th width="14%">Total Due</th>
		<th width="14%">Date</th>
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
			$firmwise="";		$ft=0;		$total_due=0;
			$firesql="select * from sp_transaction where cust_id=".$custid." and status='Due' order by sys_creation_date, firm_name desc"; //TAKE INNER JOIN OF CUST_INFO AND M_TRANSACTION
			$res=mysqli_query($con1,$firesql);
			$trans=0;
			while($row=mysqli_fetch_array($res))
			{
			$time=(float)(strtotime(date("d-m-Y"))-strtotime($row['sys_update']))/86400;
			$trans=$row['trans_id'];
		$total_due=round($row['total_bill']-$row['Paid']+$row['Interest_Amt_Due']+ (($row['total_bill']-$row['Paid'])*(float)($time)*(float)$row['Interest'])/36500);			
			if($firmwise!=$row['firm_name'])
				{
				if($firmwise!="")
				{
				echo "<em style=color:red;font-size:14px>Total Due in ".$firmwise . " =Rs. ".$ft.
				'&nbsp;&nbsp;<a href=./add_sell_update.php?firm_name='.$row['firm_name'].'&custid='.$custid.'&trans_id='.$row['trans_id'].'>Click here to Add Deposit</a>
				</em><br />';	
//				echo 'Click here to Add Deposit';
				}
				$firmwise=$row['firm_name'];
				$ft=0;				
				}
				$ft+=$total_due;
			
//echo '<tr><td style="color:red"><a href=./show_transdetail.php?custid='.$row['cust_id'].'&trans_id='.$row['trans_id'].'&firm_name='.$row['firm_name'].'>'.$row['trans_id'].'/'.$row['cust_id'].'</a></td>';

//echo '<td>'.$row['firm_name'].'</td>';

echo '<td style="color:red"><a href=./show_transdetail.php?custid='.$row['cust_id'].'&trans_id='.$row['trans_id'].'&firm_name='.$row['firm_name'].'>'.$row['item_purchased'].'</td>';
//				echo '<td>'.($row['total_bill']-$row['Paid']).'</td>';		
//				echo '<td>'.round($row['Interest_Amt_Due']+ (($row['total_bill']-$row['Paid'])*(float)($time)*(float)$row['Interest'])/36500).'</td>';		
			//	echo '<td>'.$row['Interest'].'%</td>';
			echo '<td>'.$total_due.'</td>';
				echo '<td>'.$row['date'].'</td>';
				echo '<td>'.$row['comments'].'</td>';
				echo '</td></tr>';				
			}	
			echo "<em style=color:red;font-size:14px>Total Due in ".$firmwise . " =Rs. ".$ft.
			'&nbsp;&nbsp;<a href=./add_sell_update.php?firm_name='.$firmwise.'&custid='.$custid.'&trans_id='.$trans.'>Click here to Add Deposit</a></em>
			';	
			mysqli_close($con1);
	}catch(Exception $s)
	{
		echo $s->getMessage();
	}

echo '</tbody>
</table>
';
}

echo '<hr>';
function show_m_transaction($custid)
{
echo '<br />
<h3>Mortgage Firms Brief</h3>
<table class="zebra">
<h4>Mortgage Transactions for Customer ID: '.$custid.'</h4>
		<thead>
		<tr>
		<th width="15%">Sr No. / Cust-ID</th>
		<th width="15%">Firm</th>
		<th width="10%">Mortgage</th>
		<th width="10%">Principal Due</th>
		<th width="14%">Interest Amt Due</th>
		<th width="14%">Total Due</th>
		<th width="14%">Date</th>
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
			$firmwise="";		$ft=0;
			$firesql="select * from m_transaction where custid=".$custid." and comments!='DONE' order by firm_name desc"; //TAKE INNER JOIN OF CUST_INFO AND M_TRANSACTION
			$res=mysqli_query($con1,$firesql);
			while($row=mysqli_fetch_array($res))
			{
				$time=(float)(strtotime(date("d-m-Y"))-strtotime($row['till_date']))/86400;
				
				$total_due=round($row['exchange_amt']-$row['till_date_return']+$row['till_date_interest']+(($row['exchange_amt']-$row['till_date_return'])*$row['Interest']*$time)/36500);
				if($total_due<1)continue;
				
				if($firmwise!=$row['firm_name'])
				{
				if($firmwise!="")	echo "<em style=color:red;font-size:14px>Total Due in ".$firmwise . " =Rs. ".$ft.'</em>';	
				$firmwise=$row['firm_name'];
				$ft=0;				
				}
				$ft+=$total_due;
				echo '<tr><td style="color:red"><a href=./show_mtransdetail.php?custid='.$row['custid'].'&trans_id='.$row['trans_id'].'&firm_name='.$row['firm_name'].'>'.$row['trans_id'].'/'.$custid.'</a></td>';
				echo '<td style="color:red"><a href=./show_mtransdetail.php?custid='.$row['custid'].'&trans_id='.$row['trans_id'].'&firm_name='.$row['firm_name'].'>'.$row['firm_name'].'</td>';
				echo '<td>'.$row['m_item'].' '.$row['m_item_wt'].' gms</td>';				
				echo '<td>'.($row['exchange_amt']-$row['till_date_return']).'</td>';
				echo '<td>'.round($row['till_date_interest']+(($row['exchange_amt']-$row['till_date_return'])*$row['Interest']*$time)/36500).'</td>';
echo '<td>'.$total_due.'</td>';				
				echo '<td>'.$row['sys_cre_date'].'</td>';		
				echo '<td>'.$row['comments'].'</td>';		
				echo '</td></tr>';				
			}
			echo "<em style=color:red;font-size:14px>Total Due in ".$firmwise . " =Rs. ".$ft.'</em>';	
			mysqli_close($con1);
	}catch(Exception $s)
	{
		echo $s->getMessage();
	}

echo '</tbody>
</table>
';
}

?>
</div>
<br />
</center>
<?php include 'footer.html';?>
</body>
</html>