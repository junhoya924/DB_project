<?php
    $con = mysql_connect("localhost","root","autoset");
    
    $select = mysql_select_db('courier', $con);

    $query = "UPDATE `courierinfo` SET `isdelivered`= 0 WHERE identi_num = 101";
    mysql_query($query,$con);
    
    $q = "UPDATE `courierinfo` SET `isdelivered`= 1 WHERE identi_num = 200";
    mysql_query($q,$con);
    
    $qy = "UPDATE `courierinfo` SET `isdelivered`= 0 WHERE identi_num = 500";
    mysql_query($qy,$con);
?>