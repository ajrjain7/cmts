<?php session_start();
if(!isset($_SESSION['_uname'])||$_SESSION['_uname']==null)
{ printf("<script>location.href='./login.php?desc=Login required'</script>");
}
include 'header.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<style>
	header{
	padding: 20px 30px 20px 30px;
	margin: 0px 20px 10px 20px;
	display: block;
    text-align: center;
}
#doner_list {
	position:absolute;
	width:283px;
	height:875px;
	z-index:1;
	left: 942px;
	top: 164px;
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
				<h1>Add New Customer</h1>
        </header>       
		<center><span id="desc" style="font-family:Georgia, 'Times New Roman', Times, serif"><?php echo $_GET['desc1'];?></span></center>
      <div  class="form">
      		<form id="newcustform" action="jdbc/insert_newcust.php" method="post"> 
    			<p class="contact"><label for="customer_name">Customer First Name*</label></p> 
    			<input id="customer_name" name="customer_name" placeholder="Enter First Name" required="" value=""  type="text">
				
				<p class="contact"><label for="surname">Surname*</label></p> 
    			<input id="surname" name="surname" placeholder="Enter Surname" required="" value="" type="text">
                
                <p class="contact"><label for="father">Customer Father Name*</label></p> 
    			<input id="customer_father" name="customer_father" placeholder="Enter Full Name" value="" required="" type="text">
                
                <p class="contact"><label for="city">City*</label></p> 
    			<input id="city" name="city" placeholder="City" required="" value="" type="text"> 
                
                <p class="contact"><label for="mobile">Mobile*</label></p> 
    			<input id="mobile" name="mobile" placeholder="Enter Mobile Number" value="" required="" maxlength="10" size="10" type="text">
                
                <p class="contact"><label for="phone">Phone</label></p> 
    			<input id="phone" name="phone" placeholder="Enter Phone Number" required="" value="" type="text"> 
    			  
        
               <p class="contact"><label for="address">Address*</label></p> 
    			<textarea name="address" id="address" rows="4" cols="63"></textarea>
 
            	<p class="contact"><label for="fsurname">Family Surname*</label></p> 
            <input id="fsurname" name="fsurname" placeholder="Family Name" required="" type="text" value=""> <br>
            <input class="buttom" name="submit" id="submit" value="Submit!" type="submit"> 	 
   </form> 
</div>
<br />
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

</body>
</html>
