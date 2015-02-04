<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test video out</title>

</head>
    

<body>
   <?php $url = urlencode('rtmp://88.190.203.95:33333/myapp'); ?>
    
    <div id="flashContent" style="border: 1px solid red; height: 200px; width: 250px">
    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="240" height="180"  align="middle">
        <param name="movie" value="/chat.swf" />
        <param name="quality" value="high" />
        <param name="bgcolor" value="#000000" />
        <param name="play" value="true" />
        <param name="loop" value="true" />
        <param name="wmode" value="window" />
        <param name="scale" value="showall" />
        <param name="menu" value="true" />
        <param name="devicefont" value="false" />
        <param name="salign" value="" />
        <param name="allowScriptAccess" value="always" />
        <param name="FlashVars" value="streamName=user911&url=<?= $url ?>&micOn=false&type=in" />
        <!--[if !IE]>-->
        <object type="application/x-shockwave-flash" data="/chat.swf" width="240" height="180">
            <param name="movie" value="/chat.swf" />
            <param name="quality" value="high" />
            <param name="bgcolor" value="#000000" />
            <param name="play" value="true" />
            <param name="loop" value="true" />
            <param name="wmode" value="window" />
            <param name="scale" value="showall" />
            <param name="menu" value="true" />
            <param name="devicefont" value="false" />
            <param name="salign" value="" />
            <param name="allowScriptAccess" value="always" />
            <param name="FlashVars" value="streamName=user911&url=<?= $url ?>&micOn=true&type=in" />
            <!--<![endif]-->
            <a href="http://www.adobe.com/go/getflash">
                <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Загрузить Adobe Flash Player" />
            </a>
            <!--[if !IE]>-->
        </object>
        <!--<![endif]-->
    </object>
</div>
    
</body>
</html>
