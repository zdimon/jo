<?php
require_once 'connect.php';
$id = (int) @$_GET['id'];
if($id>0)
{
$result=  pg_query("select newsletter_id from mailer WHERE id =".$id);
pg_query("update mailer set is_read=true WHERE id =".$id);
if ($result) {
   
   $arr = pg_fetch_array($result, 0, PGSQL_NUM);
   $res =  pg_query("select content, css from newsletter WHERE id =".$arr[0]);
   $arr2 = pg_fetch_array($res, 0, PGSQL_NUM);
   header('Content-Type: text/html; charset=utf-8');
  
  }
}

?>

<html>
    <head></head>
    <body style="color: white">
        
      <style type="text/css">
       <?=   $arr2[1]; ?>  
          
.text {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	font-weight: normal;
}

.text1 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 16px;
	font-weight: bold;
	color: #00F;
	background-color: #FF0;
}
.tit {
	font-size: 20px;
    font-family: Verdana, Geneva, sans-serif;
	font-weight: bold;
	color: #F00;
}

.yellow
{
    background: #FFFF00;
}

.shadow { border-radius:20px; box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.5), 0px 3px 3px 0px rgba(237, 200, 240, 0.5) inset; margin: 10px 0 20px 0; padding: 10px; width: 600px; 
}
</style>
<?=   $arr2[0]; ?>

    </body>
</html>