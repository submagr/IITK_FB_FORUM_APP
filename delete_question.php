<?php session_start(); ?>
<!DOCTYPE html>
<html>
<body>

<?php

if($_SESSION['loggedin']===1)
 {  


include 'connection.php' ;
$tbl_name="forum_question"; // Table name
 
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select tfh DB");

$delete = $_GET['id'] ;
mysql_query("DELETE FROM $tbl_name WHERE id='$delete'");


$tbl_name2="forum_answer"; // Switch to table "forum_answer"
$sql2="SELECT * FROM $tbl_name2 WHERE question_id='$delete'";
$result2=mysql_query($sql2);
while($rows=mysql_fetch_array($result2)){

mysql_query("DELETE FROM $tbl_name2 WHERE question_id='$delete'");

}
mysql_close() ;
?>


<div align="center">
<h1>
<p>  YOUR COMMENT IS DELETED ! </p>
</h1>
<h4>
<a href="main_forum.php"> CLICK HERE TO GO TO MAIN PAGE</a>
</h4>
</div>
</body>
<?php }
else { header("Location:signinform.php") ; } ?>
</html>
