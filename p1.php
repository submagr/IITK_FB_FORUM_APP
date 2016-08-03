<pre><?php  
print_r($_POST);
$cn=mysqli_connect("localhost","rishav","1234567890") or die("could not connect to db".mysqli_error());
if($cn){echo "connected to databse";}
mysqli_select_db($cn,"logintable") or die("<br>could not select db");
echo "<br>i'm audible,hence db selected";
$usernames=mysqli_real_escape_string($cn,$_POST['username']);
$passwords=mysqli_real_escape_string($cn,$_POST['password']);
echo $usernames;
echo $passwords."<br>";
$str="INSERT INTO user_input(name,pass) VALUES('$usernames','$passwords')";
mysqli_query($cn,$str);
if(mysqli_query($cn,$str))
{echo "1 record added";}
else
{die(mysqli_error($cn));}
mysqli_close($cn);
?></pre>