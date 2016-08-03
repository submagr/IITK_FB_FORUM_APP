<?php session_start(); ?>
<!DOCTYPE html>
<html>
<body>

<?php

if($_SESSION['loggedin']===0)
 {  header("Location:signinform.php") ; }


include 'connection.php' ;
$tbl_name="forum_question"; // Table name
 
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select tfh DB");

$_SESSION['ids']=$id=$_GET['id'];
echo $_SESSION['ids'] ;
$sql="SELECT detail FROM $tbl_name WHERE id='$id'";
$result=mysql_query($sql);
$rows=mysql_fetch_array($result); 

$sql2="SELECT topic FROM $tbl_name WHERE id='$id'";
$result2=mysql_query($sql2);
$rows2=mysql_fetch_array($result2);?>

<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<form action="edit_question.php" method="post">

<tr>
<td width="14%"><strong>Topic</strong></td>
<td width="2%">:</td>
<td width="84%"><textarea name="topics" cols="30" rows="1" id="topics"><?php echo $rows2['topic'] ?></textarea></td>
</tr>

<tr>
<td valign="top"><strong>Detail</strong></td>
<td valign="top">:</td>
<td><textarea name="details" cols="45" rows="3" id="a_answers"><?php echo $rows['detail'] ?></textarea></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input name="id" type="hidden" value="<?php echo $id; ?>"></td>
<td><input type="submit" name="Submit" value="Submit"><input type="reset" name="Submit2" value="Reset"></td>
</tr>
</table>



</body>
</html>