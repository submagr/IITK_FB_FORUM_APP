<!DOCTYPE HTML>c
<?php session_start(); ?>
<html>

<?php

if($_SESSION['loggedin']===1)
 { 
include 'connection.php' ;
$tbl_name="forum_question";
$tbl_name2="forum_answer" ; // Table name 

// Connect to server and select databse.
$cn = mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

$searching  = $_POST["searching"] ;
 if ($searching =="yes") 
 { 
 echo "<h2>Results</h2><p>"; 
 
 //If they did not enter a search term we give them an error
 $find= $_POST["searchs"] ;
 $user= $_POST["names"] ;
 $searchtype = $_POST["searchtype"] ;
  if ($find == "" && $user =="") 
 { 
 echo "<p>You forgot to enter a search term"; 
 exit; 
 } 

  $finds= $find ;  // to print seached for as it is provided by the user
 // We preform a bit of filtering 
 $find = explode(' ',$find) ;

 echo $number = sizeof($find) ;

//specify how many results to display per page
$limit = 10;

 $user = strtoupper($user); 
 $user = strip_tags($user); 
 $user = trim ($user);
 echo $user ;
 
 if($find[0] == "")
 { $data = mysql_query("SELECT * FROM $tbl_name WHERE UPPER($tbl_name.name) = '$user'");} 
$flag=0 ;
if($searchtype === "allwords")
 //Now we search for our search term, in the field the user specified
{ 
    for($i=0,$j=0;$i<$number ; $i++)
    {  
        

        if($user == "")
             { $data = mysql_query("SELECT * FROM $tbl_name WHERE UPPER($tbl_name.topic) LIKE '%$find[$i]%' OR UPPER($tbl_name.detail) LIKE '%$find[$i]%'");
                echo "chalya allword without user"; } 
        else
             { $data = mysql_query("SELECT * FROM $tbl_name WHERE UPPER($tbl_name.name) = '$user' AND (UPPER($tbl_name.topic) LIKE '%$find[$i]%' OR UPPER($tbl_name.detail) LIKE '%$find[$i]%')");
                echo "chalya allword with user";} 

        while($row = mysql_fetch_array($data))  //Calling every row having the word within it.
         	 {
         	 	$store_array[$j+$i] = $row ;
         	 	$j++ ;
         	 	$flag = 1 ;
              }             // Storing in same array as to use array_unique and to cut off the common values.
              $j-- ;
    }



     if(!$flag)
   	{ echo "<div align='center'>Sorry, but we can not find an entry to match your query<br><br>";?> 
   	 <a href="main_forum.php">CLICK HERE TO GO TO MAIN MENU </a></div>
   	 <?php exit ;        
   	  }?>




    <pre><?php print_r($store_array)?></pre>
    <?php {
        foreach ($store_array as $k=>$na)
            $new[$k] = serialize($na);
        for($a=0 ,$c=0 ; $a<sizeof($store_array) ;$a++)
           { 
              for($b=0; $b<sizeof($store_array) ;$b++)
                {
                	if($new[$a] == $new[($b+1+$a)])
                    {  $news[$c] = $new[$a]  ;  $c++ ; }                
                }
           } 
         if($c==0 && $number==1) {  $news = array_unique($new);  }
        foreach($news as $k=>$ser)
            $new1[$k] = unserialize($ser);
    }
    for($p=0 ; $p<sizeof($new1) ; $p++)
     $new2[$p] = array_unique($new1[$p]);
}

elseif ($searchtype === "anywords")
{  
	  for($i=0,$j=0;$i<$number ; $i++)
    {  
        

        if($user == "")
             { $data = mysql_query("SELECT * FROM $tbl_name WHERE UPPER($tbl_name.topic) LIKE '%$find[$i]%' OR UPPER($tbl_name.detail) LIKE '%$find[$i]%'");
                echo "chalya anyword without user"; } 
        else
             { $data = mysql_query("SELECT * FROM $tbl_name WHERE UPPER($tbl_name.name) = '$user' AND (UPPER($tbl_name.topic) LIKE '%$find[$i]%' OR UPPER($tbl_name.detail) LIKE '%$find[$i]%')");
                echo "chalya anyword with user";} 

        while($row = mysql_fetch_array($data))  //Calling every row having the word within it.
         	 {
         	 	$store_array[$j+$i] = $row ;
         	 	$j++ ;
              $flag=1 ;
              }             // Storing in same array as to use array_unique and to cut off the common values.
              $j-- ;
    }

     if(!$flag)
   	{ echo "<div align='center'>Sorry, but we can not find an entry to match your query<br><br>";  ?>
   	  <a href="main_forum.php">CLICK HERE TO GO TO MAIN MENU </a></div>
   	 <?php exit ;        
   	  }


    {
        foreach ($store_array as $k=>$na)
            $new[$k] = serialize($na);
        $uniq = array_unique($new);
        foreach($uniq as $k=>$ser)
          {  $news[$k] = unserialize($ser);
                echo $k ; }
    }  // Keeping only the distinct values in the array
   for($p=0 ; $p<($i+$j-$number+1) ; $p++)
     $new2[$p] = array_unique($news[$p]);
    
}?>
<pre><?php print_r($news)?></pre>
<pre><?php print_r($new2)?></pre>



<body>
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td width="6%" align="center" bgcolor="#E6E6E6"><strong>#</strong></td>
<td width="53%" align="center" bgcolor="#E6E6E6"><strong>Topic</strong></td>
<td width="15%" align="center" bgcolor="#E6E6E6"><strong>Views</strong></td>
<td width="13%" align="center" bgcolor="#E6E6E6"><strong>Replies</strong></td>
<td width="13%" align="center" bgcolor="#E6E6E6"><strong>Date/Time</strong></td>
</tr>
<?php 

for($i=0;$i< sizeof($new2) ;$i++) 
 {    echo sizeof($new2) ;
?>
<tr>
<td bgcolor="#FFFFFF"><?php echo $new2[$i][4]; ?></td>
<td bgcolor="#FFFFFF"><a href="view_topic.php?id=<?php echo $new2[$i][4]; ?>"><?php echo $new2[$i][0] ; ?></a><BR></td>
<td align="center" bgcolor="#FFFFFF"><?php echo $new2[$i][5]; ?></td>
<td align="center" bgcolor="#FFFFFF"><?php echo $new2[$i][7]; ?></td>
<td align="center" bgcolor="#FFFFFF"><?php echo $new2[$i][3]; ?></td>
</tr>
</BR>


<?php
 
 }?>
 </table>
 <?php
 //This counts the number or results - and if there wasn't any it gives them a little message explaining that
 
 //And we remind them what they searched for 
 echo "<b>Searched For:</b> " .$finds; 
 } ?>
 <h4 align="center"><a href="main_forum.php">CLICK HERE TO GO TO MAIN MENU</a></h4>
</body>
<?php mysql_close();
}
else {header("Location:signinform.php") ; } 
?>
</html>
