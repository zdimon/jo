<?php
require_once 'connect.php';
$id = (int) @$_GET['id'];
if($id>0)
{
$result=pg_exec("UPDATE mailer SET is_track=true WHERE id =".$id);

}
$filename =  dirname(__FILE__).'/pic.png';
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);

header("Content-Type: image/png");
echo $contents;
?>