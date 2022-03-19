<?php session_start();

	 require_once '../header.php'; 
	require_once '../include/appdb_config.ini';
	//CHECK VALUES FROM FORM ARE VALID
echo '<center><h2>please wait...</h2></center>';

insert_trans();

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

function insert_trans()
{
	try{ 
	
			$con1 = new mysqli(HOST, USER, PASSWORD, DATABASE);
			
			if(mysqli_connect_errno())	
			{
				die(' DB Connection Problem: ' . mysqli_connect_error());
			}
			
			
			$firm=trim(mysqli_real_escape_string($con1,$_POST['firm']));
			$trans_type=substr($firm,strpos($firm,"-"));
			$firm=substr($firm,0,strpos($firm,"-"));
			echo 'FIRM:  '.$firm;
			echo 'FIRM T:  '.$trans_type;
			$custid=mysqli_real_escape_string($con1,$_POST['custid']);
			$item_p=mysqli_real_escape_string($con1,$_POST['item_p']);
			$total_bill=mysqli_real_escape_string($con1,$_POST['total_bill']);
			$paid=mysqli_real_escape_string($con1,$_POST['paid']);
			$interest=mysqli_real_escape_string($con1,$_POST['net_bal']);
			$comments=mysqli_real_escape_string($con1,$_POST['comments']);
			$dos=mysqli_real_escape_string($con1,$_POST['dos']);
			$tname="";
			$trans_id=0;
			if($trans_type!="Mortgague")			//GET TRANSACTION ID
			{
			 $tname="sp_transaction";
			 $trans_id=get_transid("sp_transaction");
			}			
			if($custid==null|| $item_p==null)
			{
				
				mysqli_close($con1);
				printf("<script>location.href='../add_trans.php?desc1=<h3 style=color:red>Invalid Customer ID/Item Purchased</h3>'</script>");
			}
			
		$member_sql="INSERT INTO sp_transaction VALUES('".$firm."',".$custid.",".$trans_id.",'".$item_p."',".$total_bill.",".$paid.",0,".$interest.",'".$comments."',NOW(),NOW(),'".$dos."','Due')";
		echo '<hr>';
		echo $member_sql;
		if(mysqli_query($con1,$member_sql))
		{	       
						mysqli_close($con1);
					printf("<script>location.href='../add_trans.php?desc1=<h3 style=color:green>Transaction Added Successfully</h3>'</script>");
		}
		else 
			{
				mysqli_close($con1);
				echo 'failed';
				printf("<script>location.href='../add_trans.php?desc1=<h3 style=color:red>Failed while inserting transaction record</h3>'</script>");
			}					
	 }catch(Exception $es)
	 {
	 echo $es->getMessage();
	 	printf("<script>location.href='../php/error.php?errtype=2&errmsg=".$e->getMessage()."'</script>");
		mysqli_close($con1);
	 }
}        	
