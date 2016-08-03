<?php
if($_SESSION['loggedin']==0){
	header("Location:login.html");
}
$con=mysqli_connect("localhost","shubham","1234567890") or die(mysql_error());
if($con){
	echo "connected to db<br>"; 
}
mysqli_select_db($con,"loginform") or die(mysql_error());
echo "I am audible : hence connected to database";
$result=mysqli_query($con,"SELECT * FROM topic ORDER BY qid DESC") ;
while($r=mysqli_fetch_array($result))
{
	?>
	<h5>QUESTION :<?php echo $r['qid']."</h5>(by ".$r['qusername'].")<h2>".$r['question']."</h2>"; ?>
	<h5>ANSWERS :<br>
	<?php
		$qid=$r['qid'];
		$result_answer=mysqli_query($con,"SELECT * FROM replies where rqid=$qid");
		while($r_answer=mysqli_fetch_array($result_answer)){
				echo $r_answer['rid']."<h3>".$r_answer['reply']."</h3>(by : ".$r_answer['rusername']." )<br> ";
		} 
	?>
	<a href="reply.php?qid=<?php echo $r['qid'];?>" >View Topic </a> 
	<p>------------------------------------</p>
	<?php
}
?>
