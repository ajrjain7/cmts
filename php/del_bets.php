<?php session_start();
	require_once '../include/sb_appdb_config.ini';
        	try{  
						$bet_id=$_POST['bet_id'];
					if($bet_id=="")echo '<em style="color:red;font-color:red;font-size:16px">Please provide Ticket Id in textbox</em>';
					else
					{
						$con = new mysqli(HOST, USER, PASSWORD, DATABASE);					
						if(mysqli_connect_errno())	
						{
							die(' DB Connection Problem: ' . mysqli_connect_error());
						}
						if(revert_risk($_POST['bet_id'])==1)
						{
							$fire_sql="delete from open_bets where bet_id='".$bet_id."'";
							if(mysqli_query($con,$fire_sql))
							{	echo '<h3>Ticket '.$bet_id.'# is removed and Figures are Updated</h3>';
								mysqli_close($con);
							}
						}
						else 
						{ echo 'Some issue in updating credits, please contact helpdesk for issue: Method revert_risk()';
						mysqli_close($con);
						}
					}	
					}catch(Exception $e)
	    	     	{	
						mysqli_close($con);		
		          		echo 'Message: ' .$e->getMessage();
			 	  		printf("<script>location.href='./error.php?errtype=2&errmsg=".$e->getMessage()."'</script>");
		   		 	} 	


function revert_risk($bet_id)
{
	try{  						
			$con = new mysqli(HOST, USER, PASSWORD, DATABASE);					
			if(mysqli_connect_errno())	
			{
				die(' DB Connection Problem: ' . mysqli_connect_error());
			}
			$firesql="select risk, _uname from open_bets where bet_id='".$bet_id."'";
			$result=mysqli_query($con,$firesql);
			$flag=0;
			while($row=mysqli_fetch_array($result))
			{	$uname=$row['_uname'];
				$fire2sql="update figures set amt_at_risk=amt_at_risk-'".$row['risk']."', avail_bal=avail_bal+'".$row['risk']."',last_updated=NOW() where _uname='".$uname."'";
				
				if(mysqli_query($con,$fire2sql))
				{ echo '<hr> Note: ';					
				  $flag=1;
				}		
			}
			mysqli_close($con);
			return $flag;
		}catch(Exception $e)
	    {		mysqli_close($con);		
		   		echo 'Message: ' .$e->getMessage();
		  		printf("<script>location.href='./error.php?errtype=2&errmsg=".$e->getMessage()."'</script>");
		} 		
return 0;
}

