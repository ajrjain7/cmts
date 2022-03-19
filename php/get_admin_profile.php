<?php session_start();
if(!isset($_SESSION['user_type']))
	printf("<script>location.href='../alogin.php?desc=Login Required'</script>");		
?>

<html>
<head>
<title>Admin/Sub-Admin Information</title>

<?php
function get_admin_detail($field)
{
global $Name, $mobile, $user_type; 

        	try{  
							require_once '../include/sb_appdb_config.ini';
							$con = new mysqli(HOST, USER, PASSWORD, DATABASE);
					
						if(mysqli_connect_errno())	
						{
							die(' DB Connection Problem: ' . mysqli_connect_error());
						}
						else
						{   $uname= $_SESSION['admin_uname'] ;
							$firesql="select Name, Mobile_no, user_type from admin where _uadmin ='". $field . "'";	
							   $result = mysqli_query($con,$firesql); 
							 $flag=1;					
		    				while($row = mysqli_fetch_array($result))
		   					{	$flag=0;
				  				 $user_type=$row['user_type'];
 								 $mobile=$row['Mobile_no'];								 
								 $Name=$row['Name'];
		   					}if($flag!=0)echo '<h3>No Records Found</h3>';	
						}
	        }catch(Exception $e)
	         {
	          echo 'Message: ' .$e->getMessage();
		 				printf("<script>location.href='./error.php?errtype=2&errmsg=".$e->getMessage()."'</script>");
	   			 } 	
	  mysqli_close($con);
        	
}
if($_POST['a_uname']!=null)
get_admin_detail($_POST['a_uname']);
?>

</head>
<body>
<div id="container">   
<span id="resp"></span> 

<table width="1029" border="1" style="font-size:18px">
 <form name="editform" id="editform" method="post" action="./php/admin_update_profile.php"/>
 <?php $user=$_POST['a_uname'];
echo '<input type="hidden" value="' . $user . '" id="un" name="un" />';
?>
  <table width="692" height="374" bgcolor="#EAEAEA" style="font-size:18px">		
        <tr bgcolor=#acbcfc>
          <td>&nbsp;Name : </td>
		    <td>&nbsp;<input type="text" style="font-size:16px" value="<?php echo $Name ?>" size="20" id="fname" name="fname" onBlur="firstname()" /></td>
	    </tr>
        <tr bgcolor=#acbcfc>
          <td>&nbsp;Level : </td>
		    <td>&nbsp;<input type="text" style="font-size:16px" disabled="disabled" value="<?php echo $user_type ?>" id="lname" size="20" name="lname"/></td>
	    </tr>
        <tr bgcolor=#acbcfc>
          <td>&nbsp;Mobile No : </td>
		    <td>&nbsp;<input type="text" value="<?php echo $mobile ?>" id="mobile_no" maxlength="15" style="font-size:16px" size="15" name="mobile_no" 
			onblur="phone1()" />
			</td>
	    </tr>
		<tr></tr>
		<tr>		
	<td>&nbsp;<input type="submit" name="submit1" id="submit1" style="font-size:16px" value="Save Changes"></td>
		<td align=center>
		<h3><a href="./admin_home.php"><em>Back to Home</em></a></h3>
		</td>
<td width="30"><img src="../images/blank.gif" id="loadin" name="loadin"></td>
</tr>
</table>

 </form>	
  </div>
  
  