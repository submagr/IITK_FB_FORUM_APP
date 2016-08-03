<?php
session_start();
include 'connection.php'; 
$cn=mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysqli_select_db($cn,"$db_name")or die("cannot select DB");
$_SESSION['$lusername']=$lusername=mysqli_real_escape_string($cn,$_POST['username']);
$lpassword=mysqli_real_escape_string($cn,$_POST['password']);
mysqli_select_db($cn,"$db_name");
$result=mysqli_query($cn,"SELECT * FROM user_info WHERE username='$lusername'");
if($r = mysqli_fetch_array($result)){
	echo "<br>username matched";
	if($r['password']==$lpassword)
	{
		echo "<br>password also matched";
		$_SESSION['loggedin']=1;
		echo "<br>loggedin var==".$_SESSION['loggedin'];
		header("Location:main_forum.php");
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
}
mysqli_close($cn);
?>


