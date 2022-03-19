<?php session_start();

	 require_once '../header.php'; 
	require_once '../include/appdb_config.ini';
	//CHECK VALUES FROM FORM ARE VALID
echo '<center><h2>please wait...</h2></center>';

insertcustomer();

function get_custid()
{
	try{ 
	
			$con1 = new mysqli(HOST, USER, PASSWORD, DATABASE);
			
			if(mysqli_connect_errno())	
			{
				die(' DB Connection Problem: ' . mysqli_connect_error());
			}
			$firesql="select max(custid) from cust_info";
			$res=mysqli_query($con1,$firesql);
			if($row=mysqli_fetch_array($res))
			{
				mysqli_close($con1);
				return ($row[0]+1);
			}
			mysqli_close($con1);
			return 1;
		}catch(Exception $se)
		{
		echo 'Err in get_custid: '.$se->getMessage();
		
		}	
}

function insertcustomer()
{
	try{ 
	
			$con1 = new mysqli(HOST, USER, PASSWORD, DATABASE);
			
			if(mysqli_connect_errno())	
			{
				die(' DB Connection Problem: ' . mysqli_connect_error());
			}
			$custid=get_custid();
			$fname=mysqli_real_escape_string($con1,$_POST['customer_name']);
			$lname=mysqli_real_escape_string($con1,$_POST['surname']);
			$cust_father=mysqli_real_escape_string($con1,$_POST['customer_father']);
			$city=mysqli_real_escape_string($con1,$_POST['city']);
			$phone=mysqli_real_escape_string($con1,$_POST['phone']);
			if($phone==null|| $fname==null)
			{
				echo 'Not getting from there only';
			}
			$mobile=mysqli_real_escape_string($con1,$_POST['mobile']);
			$address=mysqli_real_escape_string($con1,$_POST['address']);
			$familyname=mysqli_real_escape_string($con1,$_POST['fsurname']);
			
			$check_sql="select * from cust_info where cust_name='".$fname."' and city='".$city."' and surname='".$lname."' and mobile='".$mobile."'";			
			$flag=0;
			$res=mysqli_query($con1,$check_sql);						
			$row=mysqli_fetch_array($res);
			while($row)
			{
				$flag=1;	
			}
			if($flag==1)
			{	
				mysqli_close($con1);
				printf("<script>location.href='../newcustomer.php?desc1=<h3 style=color:red>Duplicate Customer Details(Name, City, Mobile No.), please check</h3>'</script>");
			}
			if(strlen($mobile)!=10)
			{	mysqli_close($con1);
				printf("<script>location.href='../newcustomer.php?desc1=<h3 style=color:red>Invalid Phone Number, please enter correct details</h3>'</script>");
			}
		
			
		$member_sql="INSERT INTO cust_info VALUES(".$custid.",'".$fname."','".$lname."','".$cust_father."','".$city."','".$mobile."','".$phone."','".$address."','".$familyname."',NOW())";
		if(mysqli_query($con1,$member_sql))
		{	        echo 'Added to database';
						mysqli_close($con1);
					printf("<script>location.href='../newcustomer.php?desc1=<h3 style=color:green>Customer Added Successfully</h3>'</script>");
		}
		else 
			{
				mysqli_close($con1);
				echo 'failed';
				printf("<script>location.href='../newcustomer.php?desc1=<h3 style=color:red>Failed while inserting customer record</h3>'</script>");
			}					
	 }catch(Exception $es)
	 {
	 echo $es->getMessage();
	 	printf("<script>location.href='../php/error.php?errtype=2&errmsg=".$e->getMessage()."'</script>");
		mysqli_close($con1);
	 }
}        	
