<?php session_start(); ?>
<html>
<BODY>
<?php

if($_SESSION['loggedin']===1)
 {  

  //Session variables dont use $ sign

include 'connection.php' ;
$tbl_name="forum_answer"; // Table name 

// Connect to server and select databse.
$cn=mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select tfh DB");
$editid = $_SESSION['edit_ids'] ;
$answer = $_POST['a_answers'];

$sql="UPDATE $tbl_name SET a_answer='$answer' WHERE editid='$editid'"; //Using update not insert
$results=mysql_query($sql) ;


// Selecting row of db so as to give qid
$sql2 = "SELECT question_id FROM $tbl_name WHERE editid='$editid'" ;
$result=mysql_query($sql2) ;
$rows=mysql_fetch_array($result);


?>
<a href="view_topic.php?id=<?php echo $rows['question_id'] ;?>"> Click here to view your change </a>
<?php mysql_close() ;
 }
else {header("Location:signinform.php") ; } ?>
</BODY>
</HTML>