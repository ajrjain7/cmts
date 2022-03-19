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
<form name="searchform" action="./index.php" method="post" onSubmit="return val_form()">
City/Village : <input type="text" id="city" value="" name="city">
Customer Name: <input type="text" id="custname" value="" name="custname" size="40" maxlength="40">
<input type="submit" id="search" name="search" value="SEARCH" style="font-size:16px;color:#330033;font-family:Verdana, Arial, Helvetica, sans-serif">
</form>
<br />
<br />
<hr>
<span id="desc1"><?php echo $_GET['desc1'];?></span>
<div id="container">
<?php 

if($_POST['city']!="")
{
show_customer($_POST['city']);
}
function show_customer($cit)
{
echo '<table class="zebra">
		<thead>
		<tr>
		<th width="4%">Cust-Id</th>
		<th width="12%">Cust Name</th>
		<th width="9%">Mobile</th>
		<th width="30%">Address</th>
		<th width="14%">Family Surname</th>
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
			
			if($city=="NA")
			$firesql="select * from cust_info where cust_name like '%".$custname."%' and surname like '%".$surname."%' order by custid";
			else
			$firesql="select * from cust_info where cust_name like '%".$custname."%' and surname like '%".$surname."%' and city='".$city."' order by custid";
			$res=mysqli_query($con1,$firesql);
			while($row=mysqli_fetch_array($res))
			{
				echo '<tr><td style="color:blue"><a href=./show_custdetail.php?custid='.$row['custid'].'>'.$row['custid'].'</a></td>';
				echo '<td style="color:blue"><a href=./show_custdetail.php?custid='.$row['custid'].'>'.$row['cust_name'].' '.$row['surname'].'<br />S/o '.$row['cust_father'].'</td>';
				echo '<td>'.$row['mobile'].'</td>';		
				echo '<td>'.$row['address'].'</td>';		
				echo '<td>'.$row['family_surname'].'</td>';
				echo '</td></tr>';
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

  <div id="cont">
    <div id="cont3">
      <div id="con33">Transactions</div>
      <div id="con333">Using this option you can add the new transaction of the existing customer or the customer which is newly made. Here you can update the transaction deatils of your customer, Delete the transaction deatils of the customer, Update the transaction details of existing customers and search the customer transaction details by just entering simple details.
      </div>
    </div>
    <div id="cont2">
      <div id="con22">My Customers</div>
      <div id="con222">Using this option you can add new customers to your existing related firms you cna manage your customers details from here easily. Another option in this menu is delete customer, If some person is not your customore more than you can delete his details from here all the related data of that customer will be deleted from that firm. Also you can search your customer from many names by just typing the customer name. 
      </div>
    </div>
  </div>
  <div id="cont1">
    <div id="con11">My Firms </div>
    <div id="con111">
      Using this option you can add new firms if you have more than one firm or if you are new user then you can create your firm here by chossing this option. Another option in this menu is delete firm, If you want to delete your firm and all data related to this firm you can delete from here. Also you can search all of your firms by just typing the firm name. <br />
      <br />
    </div>
  </div>
</div>
<p>
  <?php include 'footer.html';?>
</p>
<p>&nbsp;</p>
</body>
</html>
