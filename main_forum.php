<?php session_start(); ?>
<html>
<body>

<?php

if($_SESSION['loggedin'] === 1)
{

include 'connection.php' ; 
$tbl_name="forum_question"; // Table name 

// Connect to server and select databse.
$conn=mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysqli_select_db($conn,"$db_name")or die("cannot select DB");
$sql="SELECT * FROM $tbl_name ORDER BY id DESC";
// OREDER BY id DESC is order result by descending

$result=mysqli_query($conn,$sql) ;

?>

<form align="right" action="search.php" method="POST">
<input name="searchs" id="searchs" type="text" placeholder="Type here"><br>
<input name="names" id="names" type="text" placeholder="Search by user here"><br>
<select name="searchtype" id="searchtype" tableindex="2">
<option value="allwords" selected="selected">Match All Words</option> 
<option value="anywords">Match any word</option>
</select><br>
<input id="submit" type="submit" value="Search">
<input type="hidden" name="searching" value="yes" >
</form>
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td width="6%" align="center" bgcolor="#E6E6E6"><strong>#</strong></td>
<td width="53%" align="center" bgcolor="#E6E6E6"><strong>Topic</strong></td>
<td width="15%" align="center" bgcolor="#E6E6E6"><strong>Views</strong></td>
<td width="13%" align="center" bgcolor="#E6E6E6"><strong>Replies</strong></td>
<td width="13%" align="center" bgcolor="#E6E6E6"><strong>Date/Time</strong></td>
</tr>

<?php
 
// Start looping table row
while($rows=mysqli_fetch_array($result)){
?>
<tr>
<td bgcolor="#FFFFFF"><?php echo $rows['id']; ?></td>
<td bgcolor="#FFFFFF"><a href="view_topic.php?id=<?php echo $rows['id']; ?>"><?php echo $rows['topic']; ?></a><BR></td>
<td align="center" bgcolor="#FFFFFF"><?php echo $rows['view']; ?></td>
<td align="center" bgcolor="#FFFFFF"><?php echo $rows['reply']; ?></td>
<td align="center" bgcolor="#FFFFFF"><?php echo $rows['datetime']; ?></td>
</tr>

<?php
// Exit looping and close connection 
}
mysqli_close($conn);
?>

<tr>
<td colspan="5" align="right" bgcolor="#E6E6E6"><a href="create_topic.php"><strong>Create New Topic</strong> </a></td>
</tr>
<tr>
<td colspan="5" align="right" bgcolor="#E6E6E6"><a href="logout.php">LOG OUT</a></h4></div>
</td>
</tr>
</table>
</body>
<?php } 
else {  header("Location:signinform.php") ; } ?>

</html>