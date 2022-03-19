<?php session_start();
require '../include/sb_appdb_config.ini';
$bet_id=$_POST['bet_id'];
$counter=$_POST['counter'];
$bet_detail=$_POST['betdetail'];
$ind=0;
$back_bet_detail=$bet_detail;	
//!game_desc#bet_on_team#bet_type#bet_categ#risk#sys_cre_date#
for($i=1;$i<$counter;$i++)
{	
	$single_detail=substr($bet_detail,$ind,strpos($bet_detail,"!",$ind));
	$bet_detail=substr($bet_detail,strlen($single_detail)+1);
	$game_desc=strtok($single_detail,"#");
	$game_desc=str_replace("!","",$game_desc);
	$bet_on_team=strtok("#");
	$bet_type=strtok("#");
	$bet_categ=strtok("#");
	$bet_categ=str_replace("_"," ",$bet_categ);
	$bet_risk=strtok("#");
	$sys_cre_date=strtok("#");
	$sys_cre_date=str_replace("!","",$sys_cre_date);
	$sys_cre_date=str_replace("_"," ",$sys_cre_date);
//	echo $single_detail.'<br />';
	if($bet_risk<1)revert_part_risk($bet_id,0,$game_desc,$bet_on_team,$bet_type,$bet_categ,$sys_cre_date);
	else if($bet_risk>0)update_risk($bet_id,$bet_risk,$game_desc,$bet_on_team,$bet_type,$bet_categ,$sys_cre_date);
}
printf("<script>location.href='./credit0731_user_.php?resp=<h3>BetSlip is Updated</h3>'</script>");

function revert_part_risk($bet_id,$risk,$game_desc,$bet_on_team,$bet_type,$bet_categ,$sys_date)
{
	$flag1=0;
	try{  	$sys_date=str_replace("_"," ",$sys_date);					
			$con = new mysqli(HOST, USER, PASSWORD, DATABASE);					
			
			$bet_id=mysqli_real_escape_string($con,$bet_id);
			$risk=mysqli_real_escape_string($con,$risk);
			
			if(mysqli_connect_errno())	
			{
				die(' DB Connection Problem: ' . mysqli_connect_error());
			}
			//GET THEN USERNAME OF THAT GAME
			$firesql="select risk, _uname from open_bets where bet_id='".$bet_id."' and bet_on_team='".$bet_on_team."'";
			$result=mysqli_query($con,$firesql);
			$flag=0;
			
			
			//UPDATE FIGURE FOR THAT USER
			while($row=mysqli_fetch_array($result))
			{	$uname=$row['_uname'];
				$fire2sql="update figures set amt_at_risk=amt_at_risk-'".$row['risk']."', avail_bal=avail_bal+'".$row['risk']."',last_updated=NOW() where _uname='".$uname."'";		$flag=1;
				
				if(mysqli_query($con,$fire2sql))
				{ 
					$flag1=1;
	$fire3sql="delete from open_bets where bet_id='".$bet_id."' and bet_on_team='".$bet_on_team."' and sys_creation_date='".$sys_date."'";
				  	if(mysqli_query($con,$fire3sql))
					{ 
					  echo '<h3>Game of'.$bet_type.' on '.$bet_on_team.' is Deleted </h3>';									
					  $flag1=2;
					}else echo '<h2>Some Issue in deleting game, please contact support team</h2>';//SQL3 DELETING GAME END		
				}else echo '<h2>Some Issue in deleting game, please contact support team</h2>';//SQL2 UPDATING FIGURE END
			}
			mysqli_close($con);
			if($flag1==2)return $flag;
			else echo '<h2>Some Issue in deleting game, please contact support team</h2>';//WHILE END	
		}catch(Exception $e)
	    {		mysqli_close($con);		
		   		echo 'Message: ' .$e->getMessage();
		  		printf("<script>location.href='./error.php?errtype=2&errmsg=".$e->getMessage()."'</script>");
		} 		
return 0;
}

//########################################################Below method is for updating single game bet for any user#############

function update_risk($bet_id,$bet_risk,$game_desc,$bet_on_team,$bet_type,$bet_categ,$sys_date)
{
	try{  	$sys_date=str_replace("_"," ",$sys_date);					
			$con = new mysqli(HOST, USER, PASSWORD, DATABASE);					
			$bet_id=mysqli_real_escape_string($con,$bet_id);
			$bet_risk=mysqli_real_escape_string($con,$bet_risk);
			if(mysqli_connect_errno())	
			{
				die(' DB Connection Problem: ' . mysqli_connect_error());
			}
			$firesql="select risk,win, _uname from open_bets where bet_id='".$bet_id."' and bet_on_team='".$bet_on_team."'";
			$flag=0;
			
			$result=mysqli_query($con,$firesql);
			while($row=mysqli_fetch_array($result))
			{	$uname=$row['_uname'];
				$newrisk=$row['risk']-$bet_risk;
				$newwin=$bet_risk *(float)($row['win']/$row['risk']);
				$fire2sql="update figures set amt_at_risk=amt_at_risk-'".$newrisk."', avail_bal=avail_bal+'".$newrisk."',last_updated=NOW() where _uname='".$uname."'";
				
				if(mysqli_query($con,$fire2sql))
				{ 
					$fire3sql="update open_bets set risk='".$bet_risk."',win='".$newwin."' where bet_id='".$bet_id."' and bet_on_team='".$bet_on_team."' and sys_creation_date='".$sys_date."'";
	
				  	if(mysqli_query($con,$fire3sql))
					{ 
					  echo '<h3>Game Bet on '.$bet_on_team.' Updated with New Risk '.$bet_risk.'</h3>';									
					  $flag=1;
					}//SQL3 DELETING GAME END		
				}//SQL2 UPDATING FIGURE END
			}//WHILE END	
			mysqli_close($con);
			return $flag;
		
		}catch(Exception $e)
	    {		mysqli_close($con);		
		   		echo 'Message: ' .$e->getMessage();
		  		printf("<script>location.href='./error.php?errtype=2&errmsg=".$e->getMessage()."'</script>");
		} 		
return 0;
}

?>