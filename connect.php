<?php
$con_str="host=ec2-54-246-97-240.eu-west-1.compute.amazonaws.com port=5432 dbname=d3t5trv6abohui user=qxaxmwxqfgrfyl password=qM0EQtKuv3kCIKk4BNAX6DBAVZ";
echo $con_str;
$dbconn=pg_connect($con_str) or die ("can't connect to db");
echo "i am audible hence connected to db";
$result = pg_query($dbconn, "INSERT INTO user_info(first_name, last_name) 
                  VALUES('John', 'Doe');");
var_dump($result);
?>