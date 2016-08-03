<pre><?php
$cn=mysqli_connect("localhost","shubham","1234567890") or die("could not connect to db".mysqli_error());
if($cn){
	echo "connected to databse";
}
mysqli_select_db($cn,"loginform") or die("<br>could not select db");
echo "<br>i'm audible,hence db selected";
$qusername=mysqli_real_escape_string($cn,$_POST['pname']);
$qpass=mysqli_real_escape_string($cn,$_POST['ppass']);
$str="INSERT INTO user(username,password) VALUES('$qusername','$qpass')";
if(mysqli_query($cn,$str))
{echo "<br><br><h1>account successfully created.</h1><br><h3><a href=\"login.html\">Click</a> here to login</h3>";}
else
{die(mysqli_error($cn));}
mysqli_close($cn);
?></pre>
