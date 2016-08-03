<?php session_start(); ?>
<html>
<BODY>
<?php

if($_SESSION['loggedin']===1)
{  

include 'connection.php' ;
$tbl_name="forum_question"; // Table name 

// Connect to server and select databse.
$cn=mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select tfh DB");
$id = $_SESSION['ids'] ;
$answer = $_POST['details'];
$topic = $_POST['topics'];

$sql="UPDATE $tbl_name SET topic='$topic' WHERE id='$id'"; //Using update not insert
$results=mysql_query($sql) ;

$sql2="UPDATE $tbl_name SET detail='$answer' WHERE id='$id'"; //Using update not insert
$results2=mysql_query($sql2) ;

?>
<a href="view_topic.php?id=<?php echo $id ;?>"> Click here to view your change </a>
<?php mysql_close();
}
else {header("Location:signinform.php") ; } ?>

</BODY>
</HTML>