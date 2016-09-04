<?php
	$name = $_POST['Name'];
	$id= $_POST['InputAdminID'];
	$password = $_POST['InputAdminPassword1'];
	$password_copy = $_POST['InputAdminPassword2'];
        $phoneNum = $_POST['InputPhoneNumber'];
        $address = $_POST['InputAddress'];
	$Isid = false;
	$loginsuccess = false;

	$connect = mysql_connect('localhost','root','autoset');
	
	$select = mysql_select_db('courier', $connect);

	
        
	if($password == $password_copy)
	{          
             $query_id = "SELECT * FROM Logininfo WHERE id = '".$id."'";
             $result = mysql_query($query_id, $connect);

              while($row = mysql_fetch_array($result))
               {
                    if($row[id] != NULL)
                    $Isid = true;
                }
                
		if($Isid == false && $id != root)
		{                  
                     if($address == "NULL")
                     {
                         $query_totalIdenti = "SELECT identi_num FROM Logininfo WHERE identi_num >50 ORDER BY identi_num DESC ";
                        $result =  mysql_query($query_totalIdenti, $connect);
                
                         $row = mysql_fetch_array($result);
                         $idnti_num =  $row[0] + 1;
                    
                     }else
                     {
                
                          $query_totalIdenti = "SELECT identi_num FROM Logininfo WHERE identi_num <=50 ORDER BY identi_num DESC ";
                          $result =  mysql_query($query_totalIdenti, $connect);
                
                          $row = mysql_fetch_array($result);
                             $idnti_num =  $row[0] + 1;
                    
                      }
                     $query = "INSERT INTO `Logininfo`(`id`, `password`, `identi_num`) VALUES ('$id','$password','$idnti_num')";
                     $result =  mysql_query($query, $connect);
                     
                     
                     if($idnti_num <= 50)
                     {
                         $query = "INSERT INTO `clientinfo`(`identi_num`, `name`, `phone_num`, `address`, `courier_count`) VALUES ('$idnti_num','$name','$phoneNum','$address',0)";
                         $result =  mysql_query($query, $connect);
                     
                     }else
                     {
                          $query = "INSERT INTO `deliveryinfo`(`identi_num`, `name`, `phone_num`, `income`) VALUES ('$idnti_num','$name','$phoneNum', 100)";
                         $result =  mysql_query($query, $connect);
                     
                     }
                     mysql_close($connect);
                     
                    require("FirstPage.html");
		}else
		{
			require("RegisterFailed_id.html");
		}
		
	}else
	{
		require("RegisterFailed_password.html");
	}
	
	mysql_close($connect);
?>
