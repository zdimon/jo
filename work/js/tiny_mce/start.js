tinyMCE.init({
	language:"ru",
    mode : "exact",
    elements : "content,content_1,content_2,content_3,content_4,content_5,content_6,content_7,content_8",
	theme : "advanced",
	plugins : "imagemanager,safari,style,layer,table,save,advhr,advimage,advlink,iespell,insertdatetime,preview,media,searchreplace,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras",
	theme_advanced_buttons1 : "save,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,media,cleanup,forecolor,backcolor",
	theme_advanced_buttons3 : "tablecontrols,|,removeformat,visualaid,|,sub,sup,|,charmap,advhr,ltr,rtl,|,fullscreen,preview,code",
	theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,|,visualchars,nonbreaking",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,
    content_css : "{CONTENT_CSS_1},{CONTENT_CSS_2}",
	extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style],iframe[src|width|frameborder|height|scrolling]",
    file_browser_callback : "fileBrowserCallBack"
});