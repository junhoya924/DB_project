<!doctype html>
<html lang="ko">
 <head>
  <meta charset="UTF-8">
  <title>Successs</title>
   <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 60px;
        background-color: #222;
      }
	   .form-group {
        max-width: 700px;
		min-width: 400px;
		min-height: 300px;
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
	<form role="form" action="Function.php" >
	<div class="form-group">
	</br>
	</br>
	<h3><p>Choose the Algorithm</p></h3>
	<input type = "radio" name = "group1"  checked/>Dijkstra
	<input type = "radio" name = "group1"/>Floyd
	</br>

	<h3><p>Choose the Algorithm</p></h3>
	<input type = "radio" name = "group2" value = "4" checked/>4
	<input type = "radio" name = "group2" value = "6"/>6
	<input type = "radio" name = "group2" value = "8"/>8
	</br>
	<h3><p>Page time</p></h3>
	<?
		echo "Time  " . date("G") . " :". date("i") .  " : " . date("s") ." " . date("A") . "<br />\n";
		$temp_id = $_GET['name'];
		echo $temp_id;


	?>


	<h3><p>Print Path <input type="submit" formaction="./Function.php" name="Printss" value=<?="print"; $temp_id?> style="height:20px;width:50px;font-size:10px;"/> </p></h2>
	</br>
	<img src = "graph.png" width = "600" height = "400">
</br>
	<?
		echo $print;
		
	?>
		<input type="submit"  formaction="./FirstPage.html" name="submit" value="Go to LoginPage" style="height:50px;width:150px;font-size:16px;"/>

		</br>
	</br>
		<input type="submit"  formaction="./DeliveryPage.php" name="submit" value="Go Back" style="height:50px;width:150px;font-size:16px;"/>
    
	</div>
	  </form>
 </body>
</html>
