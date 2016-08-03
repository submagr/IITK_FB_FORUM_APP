<?php
session_start(); 
if($_SESSION['loggedin']==0){
	header("Location:login.html");
}
$cn=mysqli_connect("localhost","shubham","1234567890") or die(mysql_error());
if($cn){
	echo "connected to db<br>"; 
}
mysqli_select_db($cn,"loginform") or die(mysql_error());
echo "I am audible : hence connected to database";
$rqid=$_GET['qid'];
$result=mysqli_query($cn,"SELECT * FROM topic WHERE qid='$rqid'");
$r=mysqli_fetch_array($result);
echo "<h1>Question: </h1>( by : ".$r['qusername']." )<br><h3>".$r['question']."</h3><br>";
?>
<!DOCTYPE html>
<html>
<body> 
<form method="post" action="insanswer.php">
<label for="1">Add your answer: </label>
<input type="textarea" id="1" rows="30" cols="70" name="panswer">
<input type="submit" value="Reply">
<input type="hidden" name="qid" value=<?php echo $rqid;?>
</form>
</body>
</html>

