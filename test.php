<!DOCTYPE HTML>
<?php session_start(); ?>
<html>
<body>
<?php

include 'connection.php' ;
//open database connection
$connections = mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

//specify how many results to display per page
$limit = 10;
$tbl_name="forum_question";
//get the search variable from URL
$var = mysql_real_escape_string($_GET['searchs']);
 
//get pagination
//set keyword character limit
if(strlen($var) < 3){
    $resultmsg =  "<p>Search Error</p><p>Keywords with less then three characters are omitted...</p>" ;
}
//trim whitespace from the stored variable
$trimmed = trim($var);
$trimmed1 = trim($var);
//separate key-phrases into keywords
$trimmed_array = explode(" ",$trimmed);
$trimmed_array1 = explode(" ",$trimmed1);
 
// check for an empty string and display a message.
if ($trimmed == "") {
    $resultmsg =  "<p>Search Error</p><p>Please enter a search...</p>" ;
}
 
// check for a search parameter
if (!isset($var)){
    $resultmsg =  "<p>Search Error</p><p>We don't seem to have a search parameter! </p>" ;
}
 
// Build SQL Query for each keyword entered
foreach ($trimmed_array as $trimm){
// EDIT HERE and specify your table and field names for the SQL query
// MySQL "MATCH" is used for full-text searching. Please visit mysql for details.
  echo $trimm ;
$query = "SELECT * FROM $tbl_name WHERE MATCH(topic,detail) AGAINST ('$trimm') ";
 // Execute the query to  get number of rows that contain search kewords
 $numresults=mysql_query($query);
 $row_num_links_main =mysql_num_rows($numresults);
 
 //If MATCH query doesn't return any results due to how it works do a search using LIKE
 if($row_num_links_main < 1){
    $query = "SELECT * FROM $tbl_name WHERE topic LIKE '%$trimm%' OR detail LIKE '%$trimm%' ";
    $numresults=mysql_query ($query);
    $row_num_links_main1 =mysql_num_rows ($numresults);
 }
 
 // next determine if 's' has been passed to script, if not use 0.
 // 's' is a variable that gets set as we navigate the search result pages.
 if (empty($s)) {
     $s=0;
 }
 
  // now let's get results.
  $query .= " LIMIT $s,$limit" ;
  $numresults = mysql_query ($query) or die ( "Couldn't execute query !!!" );
  $row= mysql_fetch_array ($numresults);
 
  //store record id of every item that contains the keyword in the array we need to do this to avoid display of duplicate search result.
  do{
      $adid_array[] = $row;
  }while( $row= mysql_fetch_array($numresults));
} //end foreach
 
//Display a message if no results found
if($row_num_links_main == 0 && $row_num_links_main1 == 0){
    $resultmsg = "<p>Search results for: ". $trimmed."</p><p>Sorry, your search returned zero results</p>" ;
}
 
//delete duplicate record id's from the array. To do this we will use array_unique function
?><pre><?php print_r($adid_array);?></pre>
<?php
foreach($adid_array as $adids_array)
{ $tmparr = array_unique($adids_array); }
$i=0;
?>
<pre><?php print_r($tmparr);?></pre>
<?php
foreach ($tmparr as $v) {
   $newarr[$i] = $v;
   $i++;
}
 
//total result
$row_num_links_main = $row_num_links_main + $row_num_links_main1;
 

// display an error or, what the person searched
if( isset ($resultmsg)){
    echo $resultmsg;
}else{
    echo "<p>Search results for: <strong>" . $var."</strong></p>";
    echo $r=sizeof($newarr) ;}

  /*  foreach($newarr as $value){
     echo $value ;
    // EDIT HERE and specify your table and field unique ID for the SQL query
    $row_linkcat= $newarr ;
    $row_num_links= mysql_num_rows ($newarr);
 
    //create summary of the long text. For example if the detail is your full text grab only first 130 characters of it for the result
    $introcontent = strip_tags($row_linkcat[ 'detail']);
    $introcontent = substr($introcontent, 0, 130)."...";
 
    //now let's make the keywods bold. To do that we will use preg_replace function.
    //Replace field
      $title = preg_replace ( "'($var)'si" , "<strong>\\1</strong>" , $row_linkcat[ 'topic' ] );
      $desc = preg_replace ( "'($var)'si" , "<strong>\\1</strong>" , $introcontent);
      $link = preg_replace ( "'($var)'si" , "<strong>\\1</strong>" ,  $row_linkcat[ 'field3' ]  );
 
        foreach($trimmed_array as $trimm){
            if($trimm != 'b' ){
                $title = preg_replace( "'($trimm)'si" ,  "<strong>\\1</strong>" , $title);
                $desc = preg_replace( "'($trimm)'si" , "<strong>\\1</strong>" , $desc);
                $link = preg_replace( "'($trimm)'si" ,  "<strong>\\1</strong>" , $link);
             }//end highlight
        }//end foreach $trimmed_array 
 
        //format and display search results
            echo '<div class="search-result">';
                echo '<div class="search-title">'.$title.'</div>';
                echo '<div class="search-text">';
                    echo $desc;
                echo '</div>';
                echo '<div class="search-link">';
                echo $link;
                echo '</div>';
            echo '</div>';
 
    }  //end foreach $newarr
 
    if($row_num_links_main > $limit){
    // next we need to do the links to other search result pages
        if ($s >=1) { // do not display previous link if 's' is '0'
            $prevs=($s-$limit);
            echo '<div class="search_previous"><a href="'.$PHP_SELF.'?s='.$prevs.'&q='.$var.'">Previous</a>
            </div>';
        }
    // check to see if last page
        $slimit =$s+$limit;
        if (!($slimit >= $row_num_links_main) && $row_num_links_main!=1) {
            // not last page so display next link
            $n=$s+$limit;
            echo '<div  class="search_next"><a href="'.$PHP_SELF.'?s='.$n.'&q='.$var.'">Next</a>
            </div>';
        }
    }//end if $row_num_links_main > $limit
}//end if search result*/
?>





<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td width="6%" align="center" bgcolor="#E6E6E6"><strong>#</strong></td>
<td width="53%" align="center" bgcolor="#E6E6E6"><strong>Topic</strong></td>
<td width="15%" align="center" bgcolor="#E6E6E6"><strong>Views</strong></td>
<td width="13%" align="center" bgcolor="#E6E6E6"><strong>Replies</strong></td>
<td width="13%" align="center" bgcolor="#E6E6E6"><strong>Date/Time</strong></td>
</tr>
<?php 

for($i=0;$i< ($r/8) ;$i++) 
 {    echo $newarr[0]  ;
?>
<tr>
<td bgcolor="#FFFFFF"><?php echo $newarr[4]; ?></td>
<td bgcolor="#FFFFFF"><a href="view_topic.php?id=<?php echo $newarr[4]; ?>"><?php echo $newarr[0] ; ?></a><BR></td>
<td align="center" bgcolor="#FFFFFF"><?php echo $newarr[5]; ?></td>
<td align="center" bgcolor="#FFFFFF"><?php echo $newarr[6]; ?></td>
<td align="center" bgcolor="#FFFFFF"><?php echo $newarr[3]; ?></td>
</tr>
</BR>
<?php }?>
</body>
</html>