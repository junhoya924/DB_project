<?php
    $id = $_GET['id'];
    $info = $_GET['info'];
    $iseval = 0;
    
    $con = mysql_connect("localhost","root","autoset");
    mysql_select_db("courier",$con);
    
    $q= "SELECT * FROM courierinfo WHERE identi_num = '$id'";
    $result = mysql_query($q,$con);

    while($e=mysql_fetch_array($result))
    {
        $iseval = $e[isevaluate];
    }
    
    if(!$iseval)
    {
        $p = "INSERT INTO `evaluation`(`evaluation_info`, `courier_identi`) VALUES ('$info','$id')";
        mysql_query($p,$con);
        $pp = "UPDATE `courierinfo` SET`isevaluate`= 1 WHERE identi_num = '$id'";
        mysql_query($pp,$con);
    }
?>