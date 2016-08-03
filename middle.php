<!DOCTYPE HTML>
<html>
<head>
  <title>Middle page</title>
</head>
<pre>
<?php
include 'connection.php';
$conn = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysqli_select_db($conn,"$db_name")or die("cannot select DB");
$firstNames=mysqli_real_escape_string($conn,$_POST['firstName']);
$lastNames=mysqli_real_escape_string($conn,$_POST['lastName']);
$usernames=mysqli_real_escape_string($conn,$_POST['username']);
$passwords=mysqli_real_escape_string($conn,$_POST['password']);
$emails=mysqli_real_escape_string($conn,$_POST['email']);
$sexs=mysqli_real_escape_string($conn,$_POST['sex']);
$dateOfBirths=mysqli_real_escape_string($conn,$_POST['dateOfBirth']);

$str = "INSERT INTO user_info(first_name,last_name,username,password,email,gender,dateofbirth) VALUES('$firstNames','$lastNames','$usernames','$passwords','$emails','$sexs','$dateOfBirths')";
if(mysqli_query($conn,$str))
{echo "1 record added";}
else
{die(mysqli_error($conn));}
mysqli_close($conn);
?></pre>
<body>
	<div align="center">
	<h1>"HURRAH ! YOU HAVE SIGNED UP AS A NEW USER !"</h1>
	<h4>
	<a href="signinform.php">Click here to go the sign in page</a>
    </h4>
    </div>
</body>
</html>