<?php
    $id = $_GET['id'];
    $con = mysql_connect("localhost","root","autoset");

    $cnt1 = 0;
    
    mysql_select_db("courier",$con);
    
    $p= "SELECT * FROM logininfo WHERE id = '$id'";
    $res = mysql_query($p,$con);

    while($f=  mysql_fetch_array($res))
    {
        $num = $f[identi_num];
    }
    
    $q= "SELECT * FROM courierinfo WHERE receiver_identi = '$num' ORDER BY date desc";
    $result = mysql_query($q,$con);
    
    while($e=mysql_fetch_array($result))
    {
        echo "$e[date]:$e[type]:$e[sender_name]:";
        if($e[isdelivered] == 0)
        {
            echo "배송준비중_";
        }
        else if($e[isdelivered] == 1)
        {
            echo "배송중_";
        }
        else if($e[isdelivered] == 2)
        {
            echo "배송완료_";
        }
        echo "$e[identi_num];";
        $cnt1++;
    }
    
   echo $cnt1;
   
?>