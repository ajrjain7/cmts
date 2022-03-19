<?php session_start();

if(!isset($_SESSION['_uname'])||$_SESSION['_uname']==null)
{ 
	printf("<script>location.href='../login.php?desc=Login required'</script>");
}

$custid=$_POST['custid'];
$surname=$_POST['surname'];
$cust_father=$_POST['customer_father'];
$city=$_POST['city'];
$phone=$_POST['phone'];
$mobile=$_POST['mobile'];
$address=$_POST['address'];
$f_s=$_POST['fsurname'];


        	try{  	require '../include/appdb_config.ini';
					$con = new mysqli(HOST, USER, PASSWORD, DATABASE);					
					if(mysqli_connect_errno())	
					{
						die(' DB Connection Problem: ' . mysqli_connect_error());
					}
					else
					{ 
						$firesql="update cust_info set surname='".$surname."',cust_father='".$cust_father."',mobile=".$mobile.",phone='".$phone."',address='".$address."',family_surname='".$f_s."' where custid=".$custid;			
						
							  if(mysqli_query($con,$firesql))
							  {
								 $flag1=1;	
								 mysqli_close($con);
								printf("<script>location.href='../custprofile.php?desc1=<h3 align=center>Customer Profile Updated Successfully</h3>'</script>"); 
echo '<center>If Page not Redirect back in 5 sec, please <a href="../custprofile.php?desc1=Customer Profile Updated Successfully">Click here</a></center>';								
							  }
							  else
							  {
printf("<script>location.href='../custprofile.php?desc1=<h3 align=center>Customer Profile Update Failed</h3>'</script>"); 
 								 mysqli_close($con);
							  }
						 }
				}catch(Exception $se)
				{
					echo 'Err in '.$se->getMessage();
					 mysqli_close($con);					 
				}				  		
printf("<script>location.href='../custprofile.php?desc1=<h3 align=center>Customer Profile Updated Successfully</h3>'</script>"); 								 
?>