<?php
    $id = $_GET['id'];
    $num;
    $con = mysql_connect("localhost","root","autoset");

    $cnt1 = 0;
    $cnt2 = 0;
    $cnt3 = 0;
    
    mysql_select_db("courier",$con);
    
    $p= "SELECT * FROM logininfo WHERE id = '$id'";
    $res = mysql_query($p,$con);

    while($f=  mysql_fetch_array($res))
    {
        $num = $f[identi_num];
    }
    
    $q= "SELECT * FROM clientinfo INNER JOIN courierinfo WHERE courierinfo.receiver_identi = clientinfo.identi_num AND courierinfo.receiver_identi = '$num'";
    $result = mysql_query($q,$con);
    
    while($e=mysql_fetch_array($result))
    {
        if($e[isdelivered] == 0)
        {
            $cnt2++;
        }
        else if($e[isdelivered] == 1)
        {
            $cnt3++;
        }
        
        $cnt1++;
    }
    
    echo "$cnt1:$cnt2:$cnt3";
   
?>