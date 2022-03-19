<html><head>
<?php
// You need a unique string that identifies the user. The easiest way is to
// simply use the session ID. But because sending session IDs to other servers
// can be a security problem, we use only a part of the session ID here.
// This is still a quasi-unique string, so it works just as well.
function sendmail() 
{
      $name = $_POST["Name"]; // sender
      $phone = $_POST["PhoneNumber"];
      $email = $_POST["FromEmailAddress"];
	  $subject=$name . " has query";
	  $message=$_POST["Comments"] . "\nContact No. " . $phone;
      mail("support@kaizensoft.heliohost.org",$subject,$message,"From: $email\n");       
}

?>
</head><body>
<br />

<?php
include_once 'functions.php';
if ($_POST['captcha_answer']) 
{
  // remove anything except letters and numbers (security)
  $answer = preg_replace('/[^a-z0-9]+/i', '', $_POST['captcha_answer']);
  // check answer
  
  
 if (file_get_contents("http://captchator.com/captcha/check_answer/".$_POST['cid']."/".$answer) == '1') 
 {
   
	if(!spamcheck($_POST['FromEmailAddress']))
	{
		echo '<script>location.replace("../contact.php?captcha_verify=Captcha value mismatch or spam email found")';	
	}
	else
	{  
           sendmail();
echo '<script> location.replace("../contact.php?thank=Thanks for your query, we will respond you soon"); </script>';
	}
	 
  }
  else 
      {	echo '<script> location.replace("../contact.php?captcha_verify=Captcha value mismatch"); </script>'; exit();}
} 
else 
	echo '<script> location.replace("../contact.php?captcha_verify=Captcha value mismatch"); </script>';
	exit();
 ?>
</body>

</html>
