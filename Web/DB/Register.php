<?php
	$name = $_POST['Name'];
	$id= $_POST['InputAdminID'];
	$password = $_POST['InputAdminPassword1'];
	$password_copy = $_POST['InputAdminPassword2'];
	$Isid = false;
	$loginsuccess = false;

	$connect = mysql_connect('163.180.173.95','root','autoset');
	
	$select = mysql_select_db('deliver', $connect);

	
	if($password == $password_copy)
	{
		$query_id = "SELECT * FROM deliverinfo WHERE id = '".$id."'";

		$result = mysql_query($query_id, $connect);

		while($row = mysql_fetch_array($result)){
			if($row[id] != NULL)
				$Isid = true;
		}

		if($Isid == false && $id != root)
		{
			$query_input = "INSERT INTO deliverinfo(name, id, password) VALUES ('".$name."', '".$id."', '".$password."')";
			mysql_query($query_input, $connect);
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
