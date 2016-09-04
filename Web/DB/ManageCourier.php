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
        max-width: 800px;
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
	<table class="table">
  <thead>
    <tr>
		<th>Destination</th>
      <th>Type1</th>
      <th>Type2</th>
      <th>Type3</th>
	  <th>Type4</th>
      <th>Type5</th>
      <th>Type6</th>
    </tr>
  </thead>
  <tbody>
    <?
	
$connect = mysql_connect('localhost','Fani','thwls');
	
	$select = mysql_select_db('deliver', $connect);

	$query = "SELECT * FROM courier ";
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
			
			for($j = 0; $j <7; $j++)
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
	<h2><p>Type & Income</p></h2>
	</br>
   <table class="table">
  <thead>
    <tr>
		<th>TYPE</th>
      <th>Size</th>
      <th>Income</th>
    </tr>
  </thead>
  <tbody>
    <?
	$imcome = array(
	array('1','1x1','1'),
	array('2','1x2','3'),
	array('3','2x2','7'),
	array('4','1x3','5'),
	array('5','2x3','9'),
	array('6','3x3','11')
);

$temp1 = "</tr>";
$temp2 = "<tr>";
		for($i = 0; $i <6; $i++)
		{
			echo $temp2;
			
			for($j = 0; $j <3; $j++)
			{
				echo "<td>";
				echo $imcome[$i][$j];
				echo "</td>";


			}
			echo $temp1;
		}

	
	
	?>
      
   </tbody>
</table>
	</br>
	</br>
	<center><h3><p>Do you want some change?</p></h3></center>
	</br>
	<form role="form" >
	<center><label for="1">Destination </label></center>
    <center><input type="text" class="form-control" name="Destination" style="width:150px;" placeholder="only large charater"></center>
	<center><label for="2">Type</label></center>
    <center><input type="text" class="form-control" name="Type" style="width:150px;" placeholder="only number"></center>
	<center><label for="3">Number that you want</label></center>
    <center><input type="text" class="form-control" name="Number" style="width:150px;" placeholder="Number"></center>
	</br>
	<center><button class="btn btn-default" formaction="./ChangeCourier.php">Change</button>
	
	
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
