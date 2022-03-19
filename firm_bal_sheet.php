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
<form name="searchform" action="./firm_bal_sheet.php" method="post" onSubmit="return val_form()">
City/Village : <input type="text" id="city" value="" name="city">
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



if($_POST['city']!="")
{
show_customer($_POST['city'],$_POST['firm']);
}
function show_customer($cit)
{
echo '<table class="zebra">
		<thead>
		<tr>
		<th width="4%">Firm Name</th>
		<th width="22%">Total Mortgage/Sell Amt</th>
		<th width="22%">Total Received</th>
		<th width="30%">Total Principal Due</th>
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
			$firesql="select firm_name,sum(exchange_amt),sum(till_date_return),(sum(exchange_amt)-sum(till_date_return)) from m_transaction group by firm_name";
//			else
//			$firesql="select firm_name,sum(exchange_amt),sum(till_date_return),(sum(exchange_amt)-sum(till_date_return)) from m_transaction where status!='PAID' group by firm_name";

			$res=mysqli_query($con1,$firesql);
			while($row=mysqli_fetch_array($res))
			{
				echo '<tr><td>'.$row[0].'</td>';
				echo '<td style="color:blue">'.$row[1].'</td>';			
				echo '<td style="color:blue">'.$row[2].'</td>';
				echo '<td style="color:red">'.$row[3].'</td>';
				echo '</tr>';
			}
			if($_POST['status']=="true")	
			{$firesql="select firm_name,sum(total_bill),sum(Paid),(sum(total_bill)-sum(Paid)) from sp_transaction group by firm_name";
			echo '<em style=red>Including Paid Deals in Sell-Purchase Firms</em>';
			}
			else{
			echo '<em>Excluding Paid Deals in Sell-Purchase Firms</em>';
$firesql="select firm_name,sum(total_bill),sum(Paid),(sum(total_bill)-sum(Paid)) from sp_transaction where status!='PAID' group by firm_name";			
}						$res=mysqli_query($con1,$firesql);
			while($row=mysqli_fetch_array($res))
			{
				echo '<tr><td>'.$row[0].'</td>';
				echo '<td style="color:blue">'.$row[1].'</td>';			
				echo '<td style="color:blue">'.$row[2].'</td>';
				echo '<td style="color:red">'.$row[3].'</td>';
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