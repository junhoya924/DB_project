<?php

 

$con = mysql_connect("localhost","root","autoset");

mysql_select_db("courier",$con);

$q= "SELECT * FROM logininfo";
$result = mysql_query($q,$con);

while($e=mysql_fetch_assoc($result))
{
      $output[]=$e;
}

print (json_encode($output));

?>

