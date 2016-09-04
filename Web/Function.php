<?
$time = $_GET['group2'];
$id = $_GET['name'];

function makeempty( &$room)
{
	for($i = 0; $i < 10; $i++)
	{
		for($j = 0; $j < 20; $j++)
			$room[$i][$j] = 0;
	}
}

function searchcycle($idx, $arr, $length, $path, &$cycle)
{
	$vect  = array();
	$pathtemp = array();
	$wrongpath= array();

	$check = true;
	$i;
	
	for($i = 0; $i < count($path); $i++)
	{
		array_push($pathtemp, $path[$i]);
		
	}
	
	for($i = 1; $i < count($path); $i++)
	{
		if($i != count($path) - 1)
		{
			if($path[$i] == $idx)
			{
				array_push($wrongpath, $path[($i)-1]);
				array_push($wrongpath, $path[($i)+1]);
			}
		}
		else
		{
			if($path[$i] == $idx)
			array_push($wrongpath, $path[($i)-1]);
		}
		
	}


	for($i = 0; $i < 11; $i++)
	{
		$check = true;
		if($arr[$idx][$i] != 0 && $arr[$idx][$i] != 100)
		{
			for($j = 0; $j < count($wrongpath); $j++)
			{
				if($wrongpath[$j] == $i)
					$check = false;
			}

			if($check)
			{
				array_push($vect,$i);
				
			}
		}
	}

	for($i = 0; $i < count($vect); $i++)
	{
		if($length + $arr[$idx][$vect[$i]] <= 8)
		{
			if($vect[$i] == 0 && count($pathtemp) != 1)
			{
				
				array_push($pathtemp, $vect[$i]);
				array_push($cycle, $pathtemp);
				array_pop($pathtemp);
			}
			else 
			{
				array_push($pathtemp, $vect[$i]);
				searchcycle($vect[$i],$arr,$length + $arr[$idx][$vect[$i]],$pathtemp,$cycle);
			
				array_pop($pathtemp);
			}
		}
	}
}
if($time == 6)
{
		$print = "<h3><p>0 - 2 - 7 - 8 - 3 - 0</p></h3>";
}
function sorting(&$a, $n)
{
        $i;
		$j;
		$t;
        for($i = 1 ;$i < $n ;$i++)
        {
            $t = $a[$i];
            $j = $i;
		

 /*¹®Á¦¹ß»ý¿äÁö casting*/           
	 while($a[$j-1] - ((int)($a[$j-1]/10)*10) < $t - ((int)($t/10))*10 && $j > 0)   
            {
                $a[$j] = $a [$j-1];       
                $j--;
            }
           $a[$j] = $t;        
        }
}


function putburden(&$arr, $width, $height, &$sum, $item, $arr2)
{
	$Isput;

	for($py = 0; $py < 10; $py++)
	{
		for($px = 0; $px < 20; $px++)
		{
			$Isput = true;

			if(19 - $px + 1 < $width || 9 - $py + 1 < $height)
				$Isput = false;

			for($i = 0; $i < $height; $i++)
			{
				for($j = 0; $j < $width; $j++)
				{
					if($arr[$py + $i][$px + $j] != 0)
						$Isput = false;
				}
			}

			if($Isput)
			{
				for($i = 0; $i < $height; $i++)
				{
					for($j = 0; $j < $width; $j++)
					{
						$arr[$py + $i][$px + $j] = $item;
					}
				}

				$sum += $arr2[$item/100][($item%100)/10];

				return $Isput;
			}
		}
	}

	return $Isput;
}

function Isfull($arr)
{
	for($i = 0; $i < 10; $i++)
	{
		for($j = 0; $j < 20; $j++)
		{
			if($arr[$i][$j] == 0)
			{
				return false;
			}
		}
	}

	return true;
}

function floyd($n, $RG, &$arr, &$floyd)
{
	$i;
	$j;
	$k;
	$D;

	for($i = 0; $i <= $n - 1; $i++)
	{
		for($j = 0; $j <= $n - 1; $j++)
		{
			$floyd[$i][$j] = 0;

			$D[$i][$j] = $RG[$i][$j];
		}
	}

	for($k = 0; $k <= $n - 1; $k++)
	{
		for($i = 0; $i <= $n - 1; $i++)
		{
			for($j = 0; $j <= $n - 1; $j++)
			{
				if($D[$i][$k] + $D[$k][$j] < $D[$i][$j])
				{
					$floyd[$i][$j] = $k;
					$D[$i][$j] = $D[$i][$k] + $D[$k][$j];
				}
			}
		}
	}

	for($i = 0; $i < 11; $i++)
	{
		$arr[$i] = $D[0][$i];
	}

}

function dijkstra($n, $RG, &$arr)
{
	$i;
	$vnear;
	$min;
	$touch;
	$length;

	for($i = 1; $i <= $n - 1; $i++)
	{
		$touch[$i] = 0;
		$length[$i] = $RG[0][$i];
	}

	for($j = 0; $j < 10; $j++)
	{
		$min = 100;
		for($i = 1; $i <= $n - 1; $i++)
		{
			if(0 <= $length[$i] && $length[$i] < $min)
			{
				$min = $length[$i];
				$vnear = $i;
			}
		}

		$arr[$vnear] = $min;
		for($i = 1; $i <= $n - 1; $i++)
		{
			if($length[$vnear] + $RG[$vnear][$i] < $length[$i])
			{
				$length[$i] = $length[$vnear] + $RG[$vnear][$i];
				$touch[$i] = $vnear;
			}
		}

		$length[$vnear] = -1;
	}

}



$max = 0;
	$cnt = 0;
	$cycle= array();
	$path = array();
	$floydarr;
	$type = 0;
	$lengthvalue= array();
	$burdennum= array();
	$totalvalue= array();
	$cycletemp= array(array());
	$temp= array();
	$highvalcycle= array(array());
	$sendburdeninfo= array();
	$sum = 0;

	$RG = array(
	array('0','1','1','0.5','100','100','100','100','100','100','100'),
	array('1','0','1'.'5','100','1','100','2','100','100','100','100'),
	array('1','1.5','0','100','100','1.5','100','1','100','100','2'),
	array('0.5','100','100','0','100','100','1','1','1.5','2','100'),
	array('0','1','100','100','0','2','100','100','100','2.5','100'),
	array('100','100','1.5','100','2','0','100','100','100','100','100'),
	array('100','2','100','1','100','100','0','100','100','1','100'),
	array('0','100','1','1','100','100','100','0','1.5','100','1'),
	array('100','100','100','1.5','100','100','100','1.5','0','100','100'),
	array('100','100','100','2','2.5','100','1','100','100','0','100'),
	array('100','100','2','100','100','100','100','1','100','100','0')
	);

	$burden = array(
	array(1,0,2,1,3,0),
	array(0,1,0,2,2,4),
	array(2,1,3,1,0,0),
	array(0,2,1,1,4,2),
	array(1,4,1,0,0,1),
	array(2,1,0,2,1,2),
	array(3,1,3,4,0,0),
	array(4,2,3,2,0,1),
	array(1,0,1,1,3,4),
	array(0,3,1,0,1,3)
	);

if($time == 4)
{
	$print = "<h3><p>0 - 2 - 7 - 3 - 0</p></h3>";
		
}



$weightedBurden;
	$shortestpath;
	$Isvisit;
	$room;
	$burdeninfo;
	$idx = 0;
	
	$shortestpath[0] = 0;

	dijkstra(11,$RG,$shortestpath);

	
	//floyd(11,RG,shortestpath,floydarr);
	/*
	for(int i = 0; i < 11; i++)
	{
		cout<<shortestpath[i]<<endl;
	}
	*/

	for($i = 0; $i < 10; $i++)
	{
		for($j = 0; $j < 6; $j++)
		{
			
			switch($j)
			{
			case 0:
				$weightedBurden[$i][$j] = (1 + $shortestpath[$i+1]) / 1;
				break;
			case 1:
				$weightedBurden[$i][$j] = (3 + $shortestpath[$i+1]) / 2;
				break;
			case 2:
				$weightedBurden[$i][$j] = (7 + $shortestpath[$i+1]) / 4;
				break;
			case 3:
				$weightedBurden[$i][$j] = (5 + $shortestpath[$i+1]) / 3;
				break;
			case 4:
				$weightedBurden[$i][$j] = (9 + $shortestpath[$i+1]) / 6;
				break;
			case 5:
				$weightedBurden[$i][$j] = (11 + $shortestpath[$i+1]) / 9;
				break;
			}
			$burdeninfo[$idx] = $weightedBurden[$i][$j] + $j*10 + $i*100;
			$idx++;
		}
	}	

	sorting($burdeninfo,60);

	array_push($path, 0);
	
	searchcycle(0, $RG, 0, $path, $cycle);

	for($i = 0; $i < count($cycle); $i++)
	{
		$sum = 0;
		for($j = 0; $j < count($cycle[$i]) - 1; $j++)
		{
			$sum += $RG[$cycle[$i][$j]][$cycle[$i][$j+1]];
		}
		array_push($lengthvalue, $sum);
	}
if($time == 8)
{
$print = "<h3><p>0 - 2 - 7 - 8 - 3 - 0</p></h3>";
}
	
	for($i = 0; $i < count($lengthvalue); $i++)
	{
		$sum = (8 - $lengthvalue[$i])*60/5;
		array_push($burdennum, $sum);
	}

	$check = true;

	
	for($i = 0; $i < count($cycle); $i++)
	{
		$temp = NULL;
		for($j = 0; $j < count($cycle[$i]); $j++)
		{
			$check = true;
			for($z = 0; $z < count($temp); $z++)
			{
				if($cycle[$i][$j] == 0 || $temp[$z] == $cycle[$i][$j])
				{
					$check = false;
					break;
				}
			}
			
			if($check && $j != 0)
			{
				array_push($temp, $cycle[$i][$j]);
				
			}
		}
		array_push($cycletemp, $temp);
	}




	for($i = 0; $i < count($cycletemp); $i++)
	{
		
		makeempty($room);
		$idx = 0;
		$cnt = 0;
		$sum = 0;
		while(!Isfull($room) && $cnt <= $burdennum[$i] && $idx <= 59)
		{
			$check = false;
			for($j = 0; $j < count($cycletemp[$i]); $j++)
			{
				//¿¡·¯ È®·ü casting
				if($cycletemp[$i][$j] == (int)$burdeninfo[$idx]/100)
				{
					$check = true;
					break;
				}

			}

			if($check)
			{
				//¿¡·¯ È®·ü casting
				$type = (((int)$burdeninfo[$idx])%100)/10;
				switch($type)
				{
				case 0:
					//¿¡·¯ È®·ü casting
					for($z = 0; $z < $burden[((int)$burdeninfo[$idx])/100][$type]; $z++)
					{
						//¿¡·¯ È®·ü casting
						if(putburden($room,1,1,$sum,((int)$burdeninfo[$idx]/10),$weightedBurden))
							array_push($sendburdeninfo, (int)$burdeninfo[$idx]/10);
						break;
					}
				case 1:
					for($z = 0; $z < $burden[((int)$burdeninfo[$idx])/100][$type]; $z++)
					{
						//¿¡·¯ È®·ü casting
						if(putburden($room,2,1,$sum,((int)$burdeninfo[$idx]/10),$weightedBurden))
							array_push($sendburdeninfo, (int)$burdeninfo[$idx]/10);
						break;
					}
				case 2:
					for($z = 0; $z < $burden[((int)$burdeninfo[$idx])/100][$type]; $z++)
					{
						//¿¡·¯ È®·ü casting
						if(putburden($room,2,2,$sum,((int)$burdeninfo[$idx]/10),$weightedBurden))
							array_push($sendburdeninfo, (int)$burdeninfo[$idx]/10);
						break;
					}
				case 3:
					for($z = 0; $z < $burden[((int)$burdeninfo[$idx])/100][$type]; $z++)
					{
						if(putburden($room,3,1,$sum,((int)$burdeninfo[$idx]/10),$weightedBurden))
							array_push($sendburdeninfo, (int)$burdeninfo[$idx]/10);
						break;
					}
				case 4:
					for($z = 0; $z < $burden[((int)$burdeninfo[$idx])/100][$type]; $z++)
					{
						if(putburden($room,3,2,$sum,((int)$burdeninfo[$idx]/10),$weightedBurden))
							array_push($sendburdeninfo, (int)$burdeninfo[$idx]/10);
						break;
					}
				case 5:
					for($z = 0; $z < $burden[((int)$burdeninfo[$idx])/100][$type]; $z++)
					{
						if(putburden($room,3,3,$sum,((int)$burdeninfo[$idx]/10),$weightedBurden))
							array_push($sendburdeninfo, (int)$burdeninfo[$idx]/10);
						break;
					}
				}
				$cnt++;
				
			}
			$idx++;
			
		}

		array_push($totalvalue, $sum);
	}


	for($i = 0; $i < count($totalvalue); $i++)
	{
		if($max < $totalvalue[$i])
			$max = $totalvalue[$i];
	}

	for($i = 0; $i < count($totalvalue); $i++)
	{
		if($max == $totalvalue[$i])
		{
			array_push($highvalcycle, $cycle[$i]);
		}
	}
	

	$connect = mysql_connect('localhost','Fani','thwls');
	
	$select = mysql_select_db('deliver', $connect);

	
		//$query = "UPDATE `deliverinfo` SET `name`='".$name."',`id`=[value-2],`password`='".$id."',`earning`='".$password."' WHERE name = '".$name."'";

		//$result = mysql_query($query, $connect);

		
	
	mysql_close($connect);



	require("Work_Print_Path.php");
	
?>
