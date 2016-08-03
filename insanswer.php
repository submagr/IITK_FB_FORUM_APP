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
$qanswer=mysqli_real_escape_string($cn,$_POST['panswer']);
$lusername=mysqli_real_escape_string($cn,$_SESSION['lusername']);
$qid=$_POST['qid'];
$str="INSERT INTO replies(rqid,reply,rusername) VALUES('$qid','$qanswer','$lusername')";
if(mysqli_query($cn,$str)){
	header("Location:index.php");
}
else{
	echo "could not add data";
}
?>
