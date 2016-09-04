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
	<h2><p>Delivery List</p></h2>
	</br>
        <h3><p>Check visible</p></h3>
       <?
        $box = $_GET['box'];
         
        ?>


<input name="box[]" value="1" type="checkbox"disabled="1" checked="1"/> 
identi_num &nbsp
<input name="box[]" value="2" type="checkbox" disabled="1"checked="1"/> 
 name  &nbsp
<input name="box[]" value="3" type="checkbox" /> 
 phone_num  &nbsp
<input name="box[]" value="4" type="checkbox" /> 
 income  &nbsp &nbsp
 
 <input value="Select" type="submit" /> 


  </br>
   </br>
	<table class="table">
  <thead>
    <tr>
      <th>identi_num</th>
      <th>name</th>
      <?
            for($i = 0; $i<count($box); $i++) 
          {
            switch($box[$i])
            {
                case 3:
                echo  "<th>phone_num</th>";
                    break;
                case 4:
                    echo  "  <th>income</th>";
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
        
        $select = "SELECT identi_num, name";
        $from = "FROM Deliveryinfo";
        $where;
       
       
       $temp = ", phone_num";
       $temp1 = ", income";
        for($i = 0; $i < count($box); $i++) 
        {
          switch($box[$i])
            {
                case 3:
               $select =  "$select  $temp";
                    break;
                case 4:
                   $select = "$select $temp1";
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
