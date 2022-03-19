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
}	
	</script>
<title>Manage Sell-Purchase/Mortgage Transaction</title>	
<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	width:1131px;
	height:77px;
	z-index:1;
	top: 638px;
}
-->
</style>
</head>
<body>
<center>
<br />
<form name="searchform" action="./journel.php" method="post" onSubmit="return val_form()">
 <p>From Date: <input type="date" name="fromdate" id="fromdate" min="1979-12-31">
&nbsp;&nbsp; Till Date: <input type="date" name="todate" id="todate" ></p>&nbsp;&nbsp;
Select Firm: <select id="firm" name="firm">
			 <option selected="selected" value="ALL">ALL</option>
			 <?php 
			try{$con1 = new mysqli(HOST, USER, PASSWORD, DATABASE);		
			if(mysqli_connect_errno())	
			{
				die(' DB Connection Problem: ' . mysqli_connect_error());
			}					
			$firesql="select firm_id,firm_name from firms";
			$res=mysqli_query($con1,$firesql);			 
			while($row=mysqli_fetch_array($res))
			{
			echo '<option value="'.$row['firm_name']."#".$row['firm_type'].'">'.$row['firm_name'].'</option>';
			}
			mysqli_close($con1);
		}catch(Exception $s)
		{
			echo $s->getMessage();
		}
			 ?>	
			</select><br />
<input type="radio" name="status" id="status" value="true" />Include Completed Transaction &nbsp;&nbsp;
<input type="radio" name="status" id="status" value="false" />Exclude Completed Transaction &nbsp;&nbsp;
<input type="submit" id="search" name="search" value="Show" style="font-size:16px;color:#330033;font-family:Verdana, Arial, Helvetica, sans-serif">
</form>
<br />
<hr>
<span id="desc1"><?php echo $_GET['desc1'];?></span>
<div id="container">
<?php 



if($_POST['fromdate']!="" && $_POST['todate']!="")
{
show_customer($_POST['fromdate'],$_POST['todate']);
}
function show_customer($from,$to)
{

$t1 = strtotime($from);
$f1 = date('d-m-Y',$t1);
$t2 = strtotime($to);
$f2 = date('d-m-Y',$t2);

echo $newformat;

echo '<table class="" border=1 style="background-color:white;font-size:17px;text-align:center;color:black">
		<thead>
		<tr style="color:purple">
		<th width="10%">Firm Name</th>
		<th width="10%">Total Mortgage/Sell Amt</th>
		<th width="10%">Total Received</th>
		<th width="15%">Item-Wt</th>
		<th width="13%">Comments</th>
		<th width="15%">Last Updated</th>
		<th width="15%">Bill/Start Date</th>
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
//			if($_POST['status']=="true") 

			$firesql="select firm_name,exchange_amt,till_date_return,m_item,m_item_wt,comments,till_date,sys_cre_date from m_transaction where sys_cre_date between '".date('Y-m-d',$t1)."' and '".date('Y-m-d',$t2)."' order by firm_name";
//			else
//			$firesql="select firm_name,sum(exchange_amt),sum(till_date_return),(sum(exchange_amt)-sum(till_date_return)) from m_transaction where status!='PAID' group by firm_name";

			$res=mysqli_query($con1,$firesql);
			while($row=mysqli_fetch_array($res))
			{
			
				echo '<tr><td>'.str_replace("_"," ",$row[0]).'</td>';
				echo '<td>'.$row[1].'</td>';			
				echo '<td style="color:blue">'.$row[2].'</td>';
				echo '<td style="color:red">'.$row[3]."-".$row[4].'</td>';
				echo '<td >'.$row[5].'</td>';
				echo '<td >'.$row[6].'</td>';
				echo '<td >'.$row[7].'</td>';
					echo '</tr>';
			}
			if($_POST['status']=="true")	
			{
				$firesql="select firm_name,total_bill,Paid,item_purchased,comments,sys_update,date from sp_transaction where sys_creation_date between '".date('Y-m-d',$t1)."' and '".date('Y-m-d',$t2)."' order by firm_name";
				echo '<em style=red>Including Paid Deals in Sell-Purchase Firms</em>';
			}
			else{
					echo '<em>Excluding Paid Deals in Sell-Purchase Firms</em>';
					$firesql="select firm_name,total_bill,Paid,item_purchased,comments,sys_update,date from sp_transaction where status!='PAID' and sys_creation_date between '".date('Y-m-d',$t1)."' and '".date('Y-m-d',$t2)."' order by firm_name";
				}
			$res=mysqli_query($con1,$firesql);
			while($row=mysqli_fetch_array($res))
			{
				echo '<tr><td>'.str_replace("_"," ",$row[0]).'</td>';
				echo '<td>'.$row[1].'</td>';			
				echo '<td style="color:blue">'.$row[2].'</td>';
				echo '<td style="color:red">'.$row[3].'</td>';
				echo '<td >'.$row[4].'</td>';
				echo '<td >'.$row[5].'</td>';
				echo '<td >'.$row[6].'</td>';
				echo '</tr>';
			}	
			mysqli_close($con1);
	}catch(Exception $s)
	{
		echo $s->getMessage();
	}
}
echo '</tbody>
</table>
';
?>
</div>
<br />
</center>
<p>
  <?php include 'footer.html';?>
</p>
<p>&nbsp;</p>
</body>
</html>