<?php session_start(); ?>
<html>
<body>
<?php

if($_SESSION['loggedin']===1)
 {  

include 'connection.php' ; 
$tbl_name="forum_question"; // Table name 

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// get data that sent from form 
$topic=$_POST['topic'];
$detail=$_POST['detail'];
$name=$_SESSION['$lusername'];

$datetime=date("d/m/y h:i:s"); //create date time

$sql="INSERT INTO $tbl_name(topic, detail, name, datetime)VALUES('$topic', '$detail', '$name','$datetime')";
$result=mysql_query($sql);

if($result){
echo "Successful<BR>";
echo "<a href=main_forum.php>View your topic</a>";
}
else {
echo "ERROR";
}
mysql_close();
}
else { header("Location:signinform.php") ; }?>

</body>
</html>