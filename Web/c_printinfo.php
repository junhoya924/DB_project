<?php

$id = $_GET['id'];
$type = $_GET['type'];


$con = mysql_connect("localhost","root","autoset");

mysql_select_db("courier",$con);

if(!$type)
{
    $q= "SELECT * FROM clientinfo INNER JOIN logininfo WHERE logininfo.identi_num = clientinfo.identi_num AND logininfo.id = '$id'";
    $result = mysql_query($q,$con);
    

    while($e=mysql_fetch_array($result))
    {
        echo "$e[identi_num]:$e[name]:$e[phone_num]:$e[address]:$e[courier_count]";
    }
}
else
{
     $q= "SELECT * FROM deliveryinfo INNER JOIN logininfo WHERE logininfo.identi_num = deliveryinfo.identi_num AND logininfo.id = '$id'";
    $result = mysql_query($q,$con);
    
    while($e=mysql_fetch_array($result))
    {
       echo "$e[identi_num]:$e[name]:$e[phone_num]:$e[income]";
    }
}

?>