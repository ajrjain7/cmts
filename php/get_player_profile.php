<?php session_start();
if(!isset($_SESSION['user_type']))
	printf("<script>location.href='../alogin.php?desc=Login Required'</script>");		
?>

<html>
<head>
<title>Player Information</title>

<?php
function get_user_detail($field)
{
global $fname, $lname, $city, $country, $mobile_no, $cur_bal, $under_admin ,$emailid; 
  try{  
		require_once '../include/sb_appdb_config.ini';
		$con = new mysqli(HOST, USER, PASSWORD, DATABASE);
		if(mysqli_connect_errno())	
		{
			die('Connection Problem: ' . mysqli_connect_error());
		}
		else
		{   $flag=0;
		    $firesql="select members.fname, members.lname, members.city, members.country, members.email, members.mobile, members._uadmin, figures.avail_bal from members INNER JOIN figures on figures._uname=members._uname and members._uname='".$field."'";
		    $result=mysqli_query($con,$firesql);
		    while($row = mysqli_fetch_array($result))
		   {	$flag=1;
		  		$fname=$row['fname'];
				$lname=$row['lname'];
				$city=$row['city'];
				$country=$row['country'];
				$emailid=$row['email'];
				$mobile_no=$row['mobile'];
				$cur_bal=$row['avail_bal'];
				$under_admin=$row['_uadmin'];
				
		   }
		   if($flag==0)
		   { echo'<h3>No Record Found</h3>'; 
		   }		
		}
	 }catch(Exception $e)
 	  {   echo 'Message: ' .$e->getMessage();
		 //		 header("Location: ./error.php?errtype=2&errmsg=".$e->getMessage());
		 printf("<script>location.href='./php/error.php?errtype=2&errmsg=".$e->getMessage()."'</script>");
	  }	 
	  mysqli_close($con);
}
if($_POST['p_uname']!=null)
get_user_detail($_POST['p_uname']);
?>

</head>
<body>
<div id="container">   
<span id="resp"></span> 

<table width="1029" border="1" style="font-size:18px">
 <form name="editform" id="editform" method="post" action="php/update_profile.php"/>
 <?php $user=$_POST['p_uname'];
echo '<input type="hidden" value="' . $user . '" id="un" name="un" />';
?>
  <table width="692" height="374" bgcolor="#EAEAEA" style="font-size:18px">		
        <tr bgcolor=#acbcfc>
          <td>&nbsp;First Name : </td>
		    <td>&nbsp;<input type="text" style="font-size:16px" value="<?php echo $fname ?>" size="20" id="fname" name="fname" onBlur="firstname()" /></td>
	    </tr>
        <tr bgcolor=#acbcfc>
          <td>&nbsp;Last Name : </td>
		    <td>&nbsp;<input type="text" style="font-size:16px" value="<?php echo $lname ?>" id="lname" size="20" name="lname" onBlur="lastname()" /></td>
	    </tr>
        <tr bgcolor=#acbcfc>
          <td>&nbsp;Available Bal : </td>
		    <td>&nbsp;<input type="text" style="font-size:16px" value="<?php echo $cur_bal ?>" id="cur_bal" size="20" name="cur_bal" onBlur="val_credit()" /> </td>
	    </tr>
      
	    <tr bgcolor=#acbcfc>
          <td>&nbsp;City : </td>
		    <td>&nbsp;<input type="text" height="12px" value="<?php echo $city ?>" id="city" style="font-size:16px" size="20" name="city" /> </td>
	    </tr>
        <tr bgcolor=#acbcfc>
          <td>&nbsp;Mobile No : </td>
		    <td>&nbsp;<input type="text" value="<?php echo $mobile_no ?>" id="mobile_no" maxlength="15" style="font-size:16px" size="15" name="mobile_no" 
			onblur="phone1()" />
			</td>
	    </tr>
        <tr bgcolor=#acbcfc>
          <td>&nbsp;Country : </td>
		    <td>&nbsp;<input type="text" style="font-size:16px" value="<?php echo $country ?>" id="country" size="30" name="country" onChange="valcountry()" /> </td>
	    </tr>
        <div class="sep"></div>
        <tr bgcolor=#acbcfc>
          <td>&nbsp;Email Id</td>
		    <td>&nbsp;<input name="emailid" type="text" class="friend" id="emailid" disabled="disabled" value="<?php echo $emailid ?>" size="50"/></td>
	    </tr>
		<tr bgcolor=#acbcfc>
          <td>&nbsp;Under Sub-Admin</td>
		    <td>&nbsp;<input type="text" value="<?php echo $under_admin ?>" size="20" style="font-size:16px" id="under_admin" name="under_admin" onChange="val_admin()"/></td>
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
  
  