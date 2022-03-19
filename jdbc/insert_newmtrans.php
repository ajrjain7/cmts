<?php session_start();

	 require_once '../header.php'; 
	require_once '../include/appdb_config.ini';
	//CHECK VALUES FROM FORM ARE VALID
echo '<center><h2>please wait...</h2></center>';

insert_mtrans();

function get_transid($trans_type)
{
	try{ 
	
			$con1 = new mysqli(HOST, USER, PASSWORD, DATABASE);
			
			if(mysqli_connect_errno())	
			{
				die(' DB Connection Problem: ' . mysqli_connect_error());
			}
			$firesql="select max(trans_id) from ".$trans_type;
			$res=mysqli_query($con1,$firesql);
			if($row=mysqli_fetch_array($res))
			{
				mysqli_close($con1);
				return ($row[0]+1);
			}
			mysqli_close($con1);
			return 1;
		}catch(Exception $se)
		{
		echo 'Err in get_transid: '.$se->getMessage();
		
		}	
}

function insert_mtrans()
{
	try{ 
	
			$con1 = new mysqli(HOST, USER, PASSWORD, DATABASE);
			
			if(mysqli_connect_errno())	
			{
				die(' DB Connection Problem: ' . mysqli_connect_error());
			}
			
			
			$firm=mysqli_real_escape_string($con1,$_POST['firm']);
			$trans_type=substr($firm,strpos($firm,"-"));
			$firm=substr($firm,0,strpos($firm,"-"));
			$custid=mysqli_real_escape_string($con1,$_POST['custid']);
	 		$item_m=mysqli_real_escape_string($con1,$_POST['item_p']);
			$item_wt=mysqli_real_escape_string($con1,$_POST['item_wt']);
			$exchange_amt=mysqli_real_escape_string($con1,$_POST['exchange_amt']);
			$interest=mysqli_real_escape_string($con1,$_POST['interest']);
			$net_bal=mysqli_real_escape_string($con1,$_POST['net_bal']);
			$comments=mysqli_real_escape_string($con1,$_POST['comments']);
			$dos=mysqli_real_escape_string($con1,$_POST['dos']);
			$tname="";
			$trans_id=0;
			if($trans_type=="Mortgague")			//GET TRANSACTION ID
			{
			 $tname="m_transaction";
			 $trans_id=get_transid("m_transaction");
			}			
			if($custid==null|| $item_wt==null)
			{
				echo 'Need this things';
				// REDIRECT Back to Page
				mysqli_close($con1);
				printf("<script>location.href='../madd_trans.php?desc1=<h3 style=color:red>Invalid Customer ID/Mortgage Wt</h3>'</script>");
			}
			//$date1=strtotime(($row['game_date']));	 
			
			
		$member_sql="INSERT INTO m_transaction VALUES(".$custid.",'".$firm."','".$item_m."',".$item_wt.",".$exchange_amt.",".$interest.",0,'".$dos."',".$net_bal.",'".$comments."',0,".$trans_id.",NOW())";
		
		
		
		echo $member_sql;
		if(mysqli_query($con1,$member_sql))
		{	       
						mysqli_close($con1);
					printf("<script>location.href='../madd_trans.php?desc1=<h3 style=color:green>Transaction Added Successfully</h3>'</script>");
		}
		else 
			{
				mysqli_close($con1);
				echo 'failed';
				printf("<script>location.href='../madd_trans.php?desc1=<h3 style=color:red>Failed while inserting transaction record</h3>'</script>");
			}					
	 }catch(Exception $es)
	 {
	 echo $es->getMessage();
	 	printf("<script>location.href='../php/error.php?errtype=2&errmsg=".$e->getMessage()."'</script>");
		mysqli_close($con1);
	 }
}        	
