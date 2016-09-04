<?php
    $id = $_GET['id'];
    $con = mysql_connect("localhost","root","autoset");

    //$cnt1 = 0;
    
    mysql_select_db("courier",$con);
    
    $q= "SELECT * FROM courierinfo WHERE identi_num = '$id' ORDER BY date desc";
    $result = mysql_query($q,$con);
    
    while($e=mysql_fetch_array($result))
    {
        echo "$e[date]:$e[type]:$e[sender_name]:";
        if($e[isdelivered] == 0)
        {
            echo "배송준비중:";
        }
        else if($e[isdelivered] == 1)
        {
            echo "배송중:";
        }
        else if($e[isdelivered] == 2)
        {
            echo "배송완료:";
        }
        
     
        
       // $cnt1++;
    }
    
  // echo $cnt1;
   
?>