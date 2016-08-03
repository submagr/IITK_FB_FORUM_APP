<?php
session_start();
$cn=mysqli_connect("localhost","shubham","1234567890") or die(mysql_error());
if($cn){
	echo "connected to db<br>"; 
}
$_SESSION['lusername']=$lusername=mysqli_real_escape_string($cn,$_POST['lname']);
$_SESSION['lpassword']=$lpassword=mysqli_real_escape_string($cn,$_POST['lpass']);

mysqli_select_db($cn,"loginform") or die(mysql_error());
echo "i am audible : hence connected to database";
$result=mysqli_query($cn,"SELECT * FROM user WHERE username='$lusername'");
if($r = mysqli_fetch_array($result)){
	echo "<br>username matched";
	if($r['password']==$lpassword)
	{
		echo "<br>password also matched";
		$_SESSION['loggedin']=1;
		echo "<br>loggedin var==".$_SESSION['loggedin'];
		header("Location:index.php");
	}
	else{
		echo "<br>wrong password";
		$_SESSION['loggedin']=0;
		echo "<br>loggedin var==".$_SESSION['loggedin'];
	}
}
else
{
	echo "wrong username";
	$_SESSION['loggedin']=0;
		echo "loggedin var==".$_SESSION['loggedin'];
	print_r($r);
	echo $_SESSION['lusername'];
}
mysqli_close($cn);
?>

