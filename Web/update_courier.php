<?php
    $id = $_GET['id'];
    $con = mysql_connect("localhost","root","autoset");
    
    $select = mysql_select_db('courier', $con);

    $query = "UPDATE `courierinfo` SET `isdelivered`= 2 WHERE identi_num = $id";
    mysql_query($query,$con);
    
?>