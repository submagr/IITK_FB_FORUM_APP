<?php session_start(); ?>
<!DOCTYPE html>
<html>
<body>

<?php

if($_SESSION['loggedin']===1)
 {  


include 'connection.php' ;
$tbl_name="forum_answer"; // Table name
 
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select tfh DB");

$_SESSION['edit_ids']=$edit_id=$_GET['id'];

$sql="SELECT a_answer FROM $tbl_name WHERE editid='$edit_id'";
$result=mysql_query($sql);
$rows=mysql_fetch_array($result); ?>

<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<form action="edit_intermediate.php" method="post">
<tr>
<td valign="top"><strong>Answer</strong></td>
<td valign="top">:</td>
<td><textarea name="a_answers" cols="45" rows="3" id="a_answers"><?php echo $rows['a_answer'] ?></textarea></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input name="id" type="hidden" value="<?php echo $id; ?>"></td>
<td><input type="submit" name="Submit" value="Submit"><input type="reset" name="Submit2" value="Reset"></td>
</tr>
</table>
<?php }
else { header("Location:signinform.php") ; } 
?>

</body>
</html>