<!doctype html>
<html lang="kr">
 <head>
  <meta charset="UTF-8">
  <link href="bootstrap.css " rel="stylesheet">
  <title>Successs</title>
   <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 60px;
        background-color: #222;
      }
	   .form-group {
        max-width: 1000px;
		min-width: 400px;
		min-height: 600px;
        padding: 10px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 10px;
           -moz-border-radius: 10px;
                border-radius: 10px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-group input[type="text"],
      .form-group input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
 
    </style>
 </head>
 <body>
	<div class="container">
	<form role="form">
	<div class="form-group">
	</br>
	<h2><p>Courier List</p></h2>
	</br>
        <h3><p>Check visible</p></h3>
       <?
        $box = $_GET['box'];
        ?>


<input name="box[]" value="1" type="checkbox" disabled="1" checked="1"/> 
identi_num &nbsp
<input name="box[]" value="2" type="checkbox" /> 
 profit  &nbsp
<input name="box[]" value="3" type="checkbox" /> 
 size  &nbsp
<input name="box[]" value="4" type="checkbox" /> 
 type  &nbsp
 <input name="box[]" value="5" type="checkbox" /> 
 receiver_identi  &nbsp
  <input name="box[]" value="6" type="checkbox" /> 
  delivery_identi  &nbsp 
    <input name="box[]" value="7" type="checkbox" /> 
    isDelivered  &nbsp 
    <input name="box[]" value="8" type="checkbox" /> 
    sender  &nbsp
    <input name="box[]" value="9" type="checkbox" /> 
    date  &nbsp &nbsp
    
 <input value="Select" type="submit" /> 


  </br>
   </br>
	<table class="table">
  <thead>
    <tr>
      <th>identi_num</th>
      <?
            for($i = 0; $i<count($box); $i++) 
          {
            switch($box[$i])
            {
                case 2:
                echo  "<th>profit</th>";
                    break;
                case 3:
                    echo  " <th>size</th>";
                    break;
                case 4:
                    echo "<th>type</th>";
                break;
            case 5:
                    echo "<th>receiverID</th>";
                break;
            case 6:
                    echo "<th>deliveryID</th>";
                break;
             case 7:
                    echo "  <th>isDelivered</th>";
                break;
                case 8:
                    echo "  <th>sender</th>";
                break;
                case 9:
                    echo "  <th>date</th>";
                break;
               
            }
          }
        ?>
        
    </tr>
  </thead>
  <tbody>
    <?
	
$connect = mysql_connect('localhost','root','autoset');
	
	mysql_select_db('courier', $connect);

	 $select = "SELECT identi_num";
        $from = "FROM Courierinfo";
        $where;
       
       
       $temp = ", profit";
       $temp1 = ", size";
       $temp2 = ", type";
       $temp3 = ", receiver_identi";
       $temp4 = ", delivery_identi";
       $temp5 = ", isdelivered";
       $temp6 = ", sender_name";
       $temp7 = ", date";
       
        for($i = 0; $i < count($box); $i++) 
        {
          switch($box[$i])
            {
                case 2:
                    $select =  "$select  $temp";
                    break;
                case 3:
                    $select = "$select $temp1";
                    break;
                case 4:
                    $select = "$select $temp2";
                break;
                case 5:
                    $select =  "$select  $temp3";
                    break;
                case 6:
                    $select = "$select $temp4";
                    break;
                case 7:
                    $select = "$select $temp5";
                    break;
                 case 8:
                    $select = "$select $temp6";
                    break;
                 case 9:
                    $select = "$select $temp7";
                    break;
               
            }
        
        }
	$query = "$select $from" ;
	$result = mysql_query($query, $connect);

$i = 0;
	while($temp = mysql_fetch_array($result)){
			$RG[$i] = $temp;
			$i++;
		}

$temp1 = "</tr>";
$temp2 = "<tr>";
		for($i = 0; $i <10; $i++)
		{
			echo $temp2;
			
			for($j = 0; $j <9; $j++)
			{
				echo "<td>";
				echo $RG[$i][$j];
				echo "</td>";


			}
			echo $temp1;
		}

	mysql_close($connect);
	
	?>

	 
      
   </tbody>
</table>

	
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>

	</br>

	</br>
	
		<input type="submit" name="submit" value="Go to LoginPage" style="height:50px;width:150px;font-size:16px;"  formaction="./FirstPage.html"/>
    </br>
	</br>

		<input type="submit" name="submit" value="Go Back" style="height:50px;width:150px;font-size:16px;" formaction="./Administrator.html"/>
	</div>
	  </form>
 </body>
</html>
