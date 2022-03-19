<?php session_start();
if(!isset($_SESSION['user_type']))
	printf("<script>location.href='../alogin.php?desc=Login Required'</script>");		
?>
<html>
<head>
</head>
<body>
<div id="container">   
<em style="font-size:12px">Last 30 Bets</em>
<table width="1100" class="zebra">
		<thead>
        	<tr>
				<th width="7%">Ticket Id</th>
				<th width="15%">Game Date-time</th>
				<th width="17%">Game-Desc</th>
				<th width="10%">Sports</th>
				<th width="14%">Bet Type</th>
				<th width="10%">Risk/Win $</th>
				<th width="10%">Result</th>
				<th width="20%">Date Placed</th>
            </tr>
		</thead>
        <tbody>
    <?php
      	
        	try{  
							require_once '../include/sb_appdb_config.ini';
							$con = new mysqli(HOST, USER, PASSWORD, DATABASE);
					
						if(mysqli_connect_errno())	
						{
							die(' DB Connection Problem: ' . mysqli_connect_error());
						}
						else
						{   $uname= $_POST['p_uname'] ;
							$firesql="select bet_id, game_date, game_desc,sports, bet_type, risk, win, match_status, sys_creation_date from open_bets where _uname='". $uname . "' order by sys_creation_date desc LIMIT 30";			
							   $result = mysqli_query($con,$firesql); 
							 $flag=1;					
		    				while($row = mysqli_fetch_array($result))
		   					{	$flag=0;
			  					 echo '<tr>';
								 echo '<td>'.$row['bet_id'].'</td>';
				  				 $gd=$row['game_date'];
			            	     echo '<td>';echo $gd;echo'</td>';
                
								 $gdesc=$row['game_desc'];
								 echo '<td>'.str_ireplace("_"," ",$gdesc).'</td>';
								
								 $sports=$row['sports'];
								 echo '<td>';echo $sports;echo'</td>';
									
                	             $bet_type= $row['bet_type'];
			                	 echo '<td>';echo $bet_type; echo'</td>';
								 
								 $risk=$row['risk'];
								 $win=$row['win'];
 			                	 echo '<td>';echo $risk ."/" . $win; echo'</td>';
			                     $win_lose= $row['match_status']; //RESULT
               	                 if($win_lose==null)
				                 {echo '<td>';echo "Not Updated";echo'</td>';}
			                	else { echo '<td>';echo $win_lose;echo'</td>'; }
                
								 $date_placed=$row['sys_creation_date'];
				                 echo '<td>';echo $date_placed ." hrs";echo'</td>'; 
            				 	echo '</tr>';
		   					}if($flag!=0)echo '<h3>No Records Found</h3>';	
						}
	        }catch(Exception $e)
	         {
	          echo 'Message: ' .$e->getMessage();
		 				printf("<script>location.href='./error.php?errtype=2&errmsg=".$e->getMessage()."'</script>");
	   			 } 	
	  mysqli_close($con);
        	
        	?>
		
        </tbody>
  </table>
  </div>