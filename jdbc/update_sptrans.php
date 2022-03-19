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
			
			
			$trans_id=trim(mysqli_real_escape_string($con1,$_POST['trans_id']));

			$amt=mysqli_real_escape_string($con1,$_POST['amt']);
			$comments=mysqli_real_escape_string($con1,$_POST['comments']);
			$dos=mysqli_real_escape_string($con1,$_POST['dos']);
			if($trans_id==null|| $amt==null||$dos=="")
			{
				
				mysqli_close($con1);
				printf("<script>location.href='../update_trans.php?desc1=<h3 style=color:red>Invalid Transaction ID/Amount</h3>'</script>");
			}
			
		$member_sql="INSERT INTO sp_trans_detail VALUES(".$trans_id.",".$amt.",'".$dos."','".$comments."',NOW())";
		echo '<hr>';
		echo $member_sql;
		$Interest_Amt_Due=0;
		$status="Due";
		if(mysqli_query($con1,$member_sql))
		{		
			$firesql="select * from sp_transaction where status='Due'";
			$res=mysqli_query($con1,$firesql);
			while($row2=mysqli_fetch_array($res))
			{
				$status="Due";
				$trans_id=$row2['trans_id'];
				$time=(float)(strtotime(date("d-m-Y"))-strtotime($row2['sys_update']))/86400;
				$Interest_Amt_Due=$row2['Interest_Amt_Due']+ round(($row2['total_bill']-$row2['Paid'])*(float)($time)* (float)$row2['Interest']/36500);										
				if((round( ($row2['total_bill']-$row2['Paid'])+$Interest_Amt_Due-$amt)<1) )
				$status="PAID";		
			    if($status=="PAID")
				$update_sql="update sp_transaction set status='PAID',Paid=total_bill+".$Interest_Amt_Due.",sys_update='".$dos."', Interest_Amt_Due=".$Interest_Amt_Due." where trans_id=".$trans_id; 
				 else
					$update_sql="update sp_transaction set Paid=Paid+".$amt.",sys_update='".$dos."', Interest_Amt_Due=".$Interest_Amt_Due." where trans_id=".$trans_id;
					echo $update_sql.'<hr>';
				if(mysqli_query($con1,$update_sql))
				{
					echo 'Updated sp_transaction';					
				
				}
				else
				echo 'error';
				printf("<script>location.href='../update_trans.php?desc1=<h3 style=color:red>Entry Made Successfully</h3>'</script>");	 				
				$amt=$amt-($Interest_Amt_Due)-($row2['total_bill']-$row2['Paid']);
				if($amt<1)
				break;
			 }//END OF WHILE
			 
			printf("<script>location.href='../update_trans.php?desc1=<h3 style=color:green>Transaction Added Successfully</h3>'</script>");

		}       


		else 
			{
				mysqli_close($con1);
				echo 'failed';
				printf("<script>location.href='../update_trans.php?desc1=<h3 style=color:red>Failed while inserting transaction record</h3>'</script>");
			}					
	 }catch(Exception $es)
	 {
	 echo $es->getMessage();
	 	printf("<script>location.href='../php/error.php?errtype=2&errmsg=".$e->getMessage()."'</script>");
		mysqli_close($con1);
	 }
}        	
