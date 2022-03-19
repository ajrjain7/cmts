<?php session_start();
if(!isset($_SESSION['_uname'])||$_SESSION['_uname']==null)
{ printf("<script>location.href='./login.php?desc=Login required'</script>");
}

 $ip=getIp();
if($ip==null || $_SESSION['your_ip']!=$ip)
{
printf("<script>location.href='./login.php?desc=Your IP has changed , please relogin'</script>");
}

function getIp() {
   $ip = $_SERVER['REMOTE_ADDR'];    
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="css/demo.css" />
<link rel="stylesheet" href="css/menu.css" type="text/css" media="screen" />

	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</head>
	
<body>
<div id="title">
  <div id="title1">Welcome To CMTS
  <div id="controlpanel" class="grid_8">
					<ul style="margin-bottom:8px;">

						<li><p style="margin-bottom:0px;">Signed in as <strong><?php echo $_SESSION['_uname'];?> </strong></p></li>
						<li><a href="logout.php" class="last">Sign Out</a></li>
					</ul>
  </div>
  </div>
</div>
<div id="main1">
  <ul id="menu2">
    <li><a href="index.php" class="drop">Home</a>
      <!-- Begin Home Item -->
      <div class="dropdown_2columns">
        <!-- Begin 2 columns container -->
        <div class="col_2">
          <h2>Welcome !</h2>
        </div>
        <div class="col_2">
          <p>Hi and welcome here ! This is a website where you can keep all your business records.</p>
          <p>This website comes with high security and a large range of database with user friendly GUI.</p>
        </div>
        <div class="col_2">
		<ul class="simple">
    		<li><a href="change_pass.php" class="">Change Password</a>    </li>
			
	      	<li ><a href="aboutus.php" class="">About Us</a>    </li>	
			<li><a href="contact.php" class="">Contact Us</a>    </li>
		 </ul> 
        </div>
        <div class="col_1"> <img src="images/1.png" width="125" height="48" alt="" /></div>
        <div class="col_1">
          <p>This site has been tested in all major browsers.</p>
        </div>
      </div>
      <!-- End 2 columns container -->
    </li>
    <!-- End Home Item -->
    <li class="menu_right"><a href="#" class="drop">My Firms</a>
      <div class="dropdown_1column align_right">
        <div class="col_1">
          <ul class="simple">
            <li><a href="newfirm.php">Add New Firm</a></li>
            <li><a href="srchfirm.php">Search Firm</a></li>
			<li><a href="net_firmstatus.php">Net Firm Status</a></li>
			<li><a href="journel.php">Journel</a></li>
			<li><a href="firm_bal_sheet.php">Current Firm Status</a></li>
          </ul>
        </div>
      </div>
    </li>
    <li class="menu_right"><a href="#" class="drop">My Customers</a>
      <div class="dropdown_1column align_right">
        <div class="col_1">
          <ul class="simple">
            <li><a href="newcustomer.php">Add New Customer</a></li>
            <li><a href="index.php">Search Customer</a></li>
			<li><a href="custprofile.php">Customer Profile Update</a></li>
          </ul>
        </div>
      </div>
    </li>
    <!-- End 4 columns Item -->
    <li class="menu_right"><a href="#" class="drop">Sub - Admins</a>
      <div class="dropdown_1column align_right">
        <div class="col_1">
          <ul class="simple">
            <li><a href="newsubadmin.php">Add New Sub-Admin</a></li>
			<li><a href="update_subadmin.php">Update/Delete Sub-Admin</a></li>
          </ul>
        </div>
      </div>
    </li>
	
    <li class="menu_right"><a href="#" class="drop">Sell-Purchase Transactions</a>
      <div class="dropdown_1column align_right">
        <div class="col_1">
          <ul class="simple">
            <li><a href="add_trans.php">Add New</a></li>
            <li><a href="update_trans.php">Update Transaction</a></li>
            <li><a href="del_trans.php">Delete Transaction</a></li>
            <li><a href="search_trans.php">Search Transaction</a></li>
          </ul>
        </div>
      </div>
    </li>
    <li class="menu_right"><a href="#" class="drop">Mortagage Transactions</a>
      <div class="dropdown_1column align_right">
        <div class="col_1">
          <ul class="simple">
            <li><a href="madd_trans.php">Add New</a></li>
            <li><a href="update_mtrans.php">Update Transaction</a></li>
            <li><a href="mdel_trans.php">Delete Transaction</a></li>
            <li><a href="search_trans.php">Search Transaction</a></li>
          </ul>
        </div>
      </div>
    </li>

    <!-- End 3 columns Item -->
  </ul>
  </div>










