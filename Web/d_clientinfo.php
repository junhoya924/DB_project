<?php
    $id = $_GET['id'];
    $con = mysql_connect("localhost","root","autoset");
    
    $cnt1=0;

    mysql_select_db("courier",$con);
    
    $p= "SELECT * FROM logininfo WHERE id = '$id'";
    $res = mysql_query($p,$con);
    

    while($f=  mysql_fetch_array($res))
    {
        $num = $f[identi_num];
    }
    
    $q= "SELECT * FROM courierinfo WHERE delivery_identi = '$num'";
    $result = mysql_query($q,$con);
    $clientarr = array();
    $courierarr = array();

    while($e=mysql_fetch_array($result))
    {
        if($e[isdelivered] != 2)
        {
        array_push($clientarr, $e[receiver_identi]);
        array_push($courierarr, $e[identi_num]);
        $cnt1++;
        }
    }
 
    for($i = 0; $i < count($clientarr); $i++)
    {
        $qu = "SELECT * FROM clientinfo WHERE identi_num = $clientarr[$i]";
        $resu = mysql_query($qu,$con);
  
        
        while($z=  mysql_fetch_array($resu))
        {
            echo "$z[address]:$z[phone_num]:$z[name]:";
        }
        echo "$courierarr[$i];";
        
    }
 
   echo $cnt1;
  
?>