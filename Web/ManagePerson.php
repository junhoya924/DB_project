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
        max-width: 600px;
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
	<h2><p>Delivery Person</p></h2>
	</br>
	<div class="row">
	 <h4><div class="col-md-3">ID</div></h4>
	<h4><div class="col-md-3">NAME</div></h4>
	<h4><div class="col-md-3">PASSWORD</div></h4>
	<h4><div class="col-md-3">EARNING</div></h4>
</div>
	<?
		$connect = mysql_connect('localhost','Fani','thwls');
		$select = mysql_select_db('deliver', $connect);

		$query = "SELECT * FROM deliverinfo";
	
		$result = mysql_query($query, $connect);
		$tempNumber = 0;
		$tempNumber1 = 0;

		while($row = mysql_fetch_array($result)){

			$tempid[$tempNumber][0] = $row[id];
			$tempid[$tempNumber][1] = $row[name];
			$tempid[$tempNumber][2] = $row[password];
			$tempid[$tempNumber][3] = $row[earning];
			$tempNumber++;
			
			echo "<h4><div class='col-md-3'>$row[id]</div></h4>";
			echo "<h4><div class='col-md-3'>$row[name]</div></h4>";
			echo "<h4><div class='col-md-3'>$row[password]</div></h4>";
			echo "<h4><div class='col-md-3'>$row[earning]</div></h4>";
		}

	mysql_close($connect);
	
	?>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>

	</br>
	
		<input type="submit" name="submit" value="Go to LoginPage" style="height:50px;width:150px;font-size:16px;"/  formaction="./FirstPage.html"/>
		</br>
		</br>

		<input type="submit" name="submit" value="Go Back" style="height:50px;width:150px;font-size:16px;" formaction="./Administrator.html"/>
    
	</div>
	  </form>
 </body>
</html>
