<?php

$id = $_GET['id'];
$password = $_GET['password'];
$type = $_GET['type'];

$isok = false;
$con = mysql_connect("localhost","root","autoset");

mysql_select_db("courier",$con);

if($type == 0 || $type == 1)
{
    $q= "SELECT * FROM logininfo";
    $result = mysql_query($q,$con);

    while($e=mysql_fetch_array($result))
    {     
          if($e[id] == $id)
          {
              if($e[password] == $password)
              {

                   if($type == 1)
                   {
                       if(51 <= $e[identi_num] && $e[identi_num] <= 100)
                       {
                           $isok = true;
                           break;
                       }
                       else
                       {
                           $isok = false;

                       }
                   }
                   else
                   {
                       if(1 <= $e[identi_num] && $e[identi_num] <= 50)
                       {
                           $isok = true;
                           break;
                       }
                       else
                       {
                           $isok = false;

                       }
                   }
              }
              else
              {
                  $isok = false;
              }
          }
          else
          {
               $isok = false;
          }    
    }

    if($isok)
    {
        echo "1";
    }
    else
    {
        echo "0";
    }
}
else if($type == 2)
{
    $qq = "SELECT * FROM courierinfo";
    $resultt = mysql_query($qq,$con);
    
    while($f=mysql_fetch_array($resultt))
    {
        if($f[identi_num] == $id)
        {
            if($f[receiver_identi] == 0)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }
    }
}

?>

