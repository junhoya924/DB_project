<!doctype html>
<html lang="kr">
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
        max-width: 600px;
		min-width: 400px;
		min-height: 800px;
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
	<div class="form-group">
	</br>
	<h1><p>Welcome Deliver</p></h1>
        <h1><p>Please go to mobile application</p></h1>
	<h2><p>ID: <?=$id; $temp_id = $id;?> &nbsp Name: <?=$name?></p></h2>
	<form role="form" >
	</br>
	</br>
	
	</br>
	<h3><p>Go to work</p></h3>
	<input type="submit" name="GO" value="<?="GO"; $id?>" style="height:50px;width:150px;font-size:16px;" formaction="./Work_Print_Path.php"/>
	</br>
	
	</br>
	</br>
	</br>
	</br>
	<input type="submit" name="submit" value="Go to LoginPage" style="height:50px;width:150px;font-size:16px;" formaction="./FirstPage.html"/>
	
	</div>
  </form>
	</div>
 </body>
</html>
