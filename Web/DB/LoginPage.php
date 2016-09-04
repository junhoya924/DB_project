<?php

	$id= $_POST['InputAdminID'];
	$password = $_POST['InputAdminPassword'];
	$tempid;
	$temppass;
	$loginsuccess = false;
	$Isid = false;

	$connect = mysql_connect('http://163.180.173.95:80','root','autoset');
        echo $connect;
	if( $connect)
        {
            echo"success";
        }else
        {
            echo"failed";
        }
	$select = mysql_select_db('courier', $connect);

	$query = "SELECT * FROM logininfo WHERE id = '".$id."'";
	$result = mysql_query($query, $connect);
	
	if($id == 'root' && $password == 'admin')
	{
		$name = "Administrator";
		require("Administrator.html");
	}
	else
        {
             while($row = mysql_fetch_array($result))
             {
		if($row[id] != NULL)
		{
			$Isid = true;
			$tempid = $row[id];
			$temppass = $row[password];
			$name = $row[name];
			break;
		}
            }

	if($Isid == true)
	{
		if($tempid == $id && $temppass == $password)
			require("DeliveryPage.php");
		else
			require("LoginFailed.html");
	}
	else
	{
		require("LoginFailed.html");
	}
		}

	

		mysql_close($connect);
?>
