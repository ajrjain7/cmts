<?php session_start();
if(!isset($_SESSION['_uname'])||$_SESSION['_uname']==null)
{ printf("<script>location.href='../login.php?desc=Login required'</script>");
}
?>
<html>
<body>

<?php 
			$custid=$_POST['custid'];	
        	try{  	require '../include/appdb_config.ini';
							$con = new mysqli(HOST, USER, PASSWORD, DATABASE);
					
						if(mysqli_connect_errno())	
						{
							die(' DB Connection Problem: ' . mysqli_connect_error());
						}
						else
						{ 
							$firesql="select * from cust_info where custid=".$custid;			
							   $result1 = mysqli_query($con,$firesql); 
							 $flag1=1;					
		    				while($row=mysqli_fetch_array($result1))
		   					{	$flag1=0;								
								
    		echo '<form id="newcustform" action="./jdbc/update_cust.php" method="post"> 
			<div class="form">	<p class="contact"><label for="customer_name">Customer First Name*</label></p> 
    			<input id="customer_name" name="customer_name" disabled="disabled" placeholder="Enter First Name" required="" value='.$row['cust_name'].'  type="text">
				<input type="hidden" id="custid" name="custid" value='.$custid.'>
				<p class="contact"><label for="surname">Surname*</label></p> 
    			<input id="surname" name="surname" placeholder="Enter Surname" required="" value='.$row['surname'].' type="text">
                
                <p class="contact"><label for="father">Customer Father Name*</label></p> 
    			<input id="customer_father" name="customer_father" placeholder="Enter Full Name" value='.$row['cust_father'].' required="" type="text">
                
                <p class="contact"><label for="city">City*</label></p> 
    			<input id="city" name="city" placeholder="City" required="" value='.$row['city'].' type="text"> 
                
                <p class="contact"><label for="mobile">Mobile*</label></p> 
    			<input id="mobile" name="mobile" placeholder="Enter Mobile Number" value='.$row['mobile'].' required="" maxlength="10" size="10" type="text">
                
                <p class="contact"><label for="phone">Phone</label></p> 
    			<input id="phone" name="phone" placeholder="Enter Phone Number" required="" value='.$row['phone'].' type="text"> 
    			  
        
               <p class="contact"><label for="address">Address*</label></p> 
    			<input type="text" name="address" id="address" rows="4" value='.str_replace(" ","_",$row['address']).' cols="63">
 
            	<p class="contact"><label for="fsurname">Family Surname*</label></p> 
            <input id="fsurname" name="fsurname" placeholder="Family Name" required="" type="text" value='.$row['family_surname'].'> <br>
            <input class="buttom" name="submit" id="submit" value="Update!" type="submit">';
			}
			if($flag1!=0)echo '<h3>No Records Found</h3>';	
		}    
	echo ' </div></form> 
   
		</body>
		</html>';
		}catch(Exception $e)
	    {
	      echo 'Message: ' .$e->getMessage();
		  printf("<script>location.href='./error.php?errtype=2&errmsg=".$e->getMessage()."'</script>");
	   	} 	
	   mysqli_close($con);
?>