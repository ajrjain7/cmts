<?php echo ;


switch ($_REQUEST['errtype'])
{
case "1":
  echo "!!!Authentication Failed!!!";
  echo $_REQUEST['errmsg'];
  break;
case "2":
  echo "Something went wrong with DB server";
    echo $_REQUEST['errmsg'];
  break;
case "3":
  echo "Unexpected Behaviour found";
    echo $_REQUEST['errmsg'];
  break;
  case "6":
  echo "Session get invalidated";
    echo $_REQUEST['errmsg'];
  break;
default:
  echo "Unusual activity is dictacted";
    echo $_REQUEST['errmsg'];
}

?>

<b><a href="login.php">Back to Login Page</a> </b> 