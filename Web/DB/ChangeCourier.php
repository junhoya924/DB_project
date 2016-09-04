<?
	
	$Destination = $_GET['Destination'];
	$type= $_GET['Type'];
	$number = $_GET['Number'];

	
	$connect = mysql_connect('localhost','Fani','thwls');
	
	$select = mysql_select_db('deliver', $connect);

	$query = "SELECT * FROM courier ";
	$result = mysql_query($query, $connect);

$i = 0;
	while($temp = mysql_fetch_array($result)){
			$RG[$i] = $temp;
			$i++;
		}

$temp = 0;
	for($i = 0; $i <10; $i++)
		{
			if($Destination == $RG[$i][0])
			{
				$RG[$i][$type] = $number;
				echo "true";
				$temp = $i;
				break;
			}
			
			
			
		}

	

		$query = "UPDATE `courier` 
		SET `Destination`= '".$Destination."',
		`Type1`=".$RG[$temp][1].",
		`Type2`=".$RG[$temp][2].",
		`Type3`=".$RG[$temp][3].",
		`Type4`=".$RG[$temp][4].",
		`Type5`=".$RG[$temp][5].",
		`Type6`=".$RG[$temp][6]."
		WHERE Destination = '".$Destination."';";

	$result = mysql_query($query, $connect);
		mysql_close($connect);
	
	require("ManageCourier.php");
	?>