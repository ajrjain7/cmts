<?php  session_start();

	 require_once '../header.php'; 
	require_once '../include/appdb_config.ini';
	//CHECK VALUES FROM FORM ARE VALID
echo '<center><h2>please wait...</h2></center>';

insert_trans();

function insert_trans()
{
	try{ 
	
			$con1 = new mysqli(HOST, USER, PASSWORD, DATABASE);
			
			if(mysqli_connect_errno())	
			{
				die(' DB Connection Problem: ' . mysqli_connect_error());
			}
			
			
			$trans_id=mysqli_real_escape_string($con1,$_POST['trans_id']);
			$amt=mysqli_real_escape_string($con1,$_POST['amt']);
			$comments=mysqli_real_escape_string($con1,$_POST['comments']);
			$dos=mysqli_real_escape_string($con1,$_POST['dos']);
			if($trans_id==null|| $amt==null||$dos=="")
			{
				echo 'Transaction: '.$trans_id;
				mysqli_close($con1);
				return;	
				//printf("<script>location.href='../update_mtrans.php?&desc1=<h3 style=color:red>Invalid Transaction ID/Amount</h3>'
			}
			
		$member_sql="INSERT INTO m_trans_detail VALUES(".$trans_id.",".$amt.",'".$dos."','".$comments."',NOW())";
		echo '<hr>';
		echo $member_sql;
		$Interest_Amt_Due=0;
		$net_amt_due=0;
		$comment="NA";
		if(mysqli_query($con1,$member_sql))
		{	
			$firesql="select * from m_transaction where trans_id=".$trans_id;
			$res=mysqli_query($con1,$firesql);
			while($row2=mysqli_fetch_array($res))
			{
				$time=(float)(strtotime(date("d-m-Y"))-strtotime($row2['till_date']))/86400;
				$Interest_Amt_Due=$row2['till_date_interest']+ round(($row2['exchange_amt']-$row2['till_date_return'])*(float)($time)*(float)$row2['Interest']/36500);					
				$check_val=$row2['exchange_amt']+$row2['till_date_interest']-$row2['till_date_return']+$amt;
				if($check_val<1)
				{$comment="DONE";}			
		
		    }
			 if($comment=="DONE")
				$update_sql="update m_transaction set comments='".$comment."', till_date_return=till_date_return+".$amt.",till_date='".$dos."', till_date_interest=".$Interest_Amt_Due.", net_due_amt=exchange_amt-till_date_return where trans_id=".$trans_id;			 
			 else
			$update_sql="update m_transaction set till_date_return=till_date_return+".$amt.",till_date='".$dos."', till_date_interest=".$Interest_Amt_Due.", net_due_amt=exchange_amt-till_date_return where trans_id=".$trans_id;
			echo $update_sql;
			if(mysqli_query($con1,$update_sql))
			{
				echo 'Updated m_transaction';
				mysqli_close($con1);
				//http://localhost/cmts/show_custdetail.php?custid=2
				printf("<script>location.href='../custdetail.php?desc1=<h3 style=color:green>Transaction Added Successfully</h3>'</script>");		
			}
			else
			printf("<script>location.href='../madd_trans.php?desc1=<h3 style=color:red>Entry Made, but Interest, Paid Amt not Updated</h3>'</script>");		
		}       
		else 
			{
				mysqli_close($con1);
				echo 'failed';
				printf("<script>location.href='../update_mtrans.php?desc1=<h3 style=color:red>Failed while inserting transaction record</h3>'</script>");
			}					
	 }catch(Exception $es)
	 {
	 echo $es->getMessage();
	 	printf("<script>location.href='../php/error.php?errtype=2&errmsg=".$e->getMessage()."'</script>");
		mysqli_close($con1);
	 }
}        	
