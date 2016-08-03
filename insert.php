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
$lusername=$_SESSION['lusername'];
$lquestion=mysqli_real_escape_string($cn,$_POST['pquestion']);

$str="INSERT INTO topic(qusername,question) VALUES('$lusername','$lquestion')";
if(mysqli_query($cn,$str))
{
	echo "ur comment successfully added";
}
else
{
	echo mysql_error();
}
header("Location:index.php");
?>