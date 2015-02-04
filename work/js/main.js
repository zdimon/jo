$(document).ready(function(){var newEnterSite=$('.newEnterSite');$('.all').click(function(){if($(this).is(':checked')){$('[name="sel"]').not(this).attr('checked','checked')}else{$('[name="sel"]').not(this).removeAttr('checked')}})
if($('.menu_left_poss').length){var method='easeOutCirc';var a_speed=600;var slTop=$('.menu_left_poss').offset().top
$(window).bind('scroll',function(){move_1()})
function move_1(){if($(document).scrollTop()>slTop){$('.menu_left_poss').stop().animate({marginTop:$(document).scrollTop()-slTop},a_speed,method)}else{$('.menu_left_poss').stop().animate({marginTop:'0'},a_speed,method)}}
move_1()}
$('.middle_inner').each(function(){$('<span>').addClass('helper').appendTo($(this).parent());})
$('.navigator a').each(function(){var nav_el=$(this);nav_el.after('<span>&nbsp;/</span>').css({padding:'0'})})
$('.tab_wrap').each(function(){var tab_wrap=$(this);var tab_title=$('.tab_title',tab_wrap);var tab_content=$('.tab_content',tab_wrap);$('.t_cont:first',tab_wrap).addClass('tf');$('.cur',tab_wrap).next(tab_content).show().addClass('tc_show')
tab_height()
tab_title.click(function(){tab_title.removeClass('cur').filter(this).addClass('cur');tab_content.hide().filter($(this).next(tab_content)).show().addClass('tc_show')
tab_height()
return false})
function tab_height(){tab_wrap.height($('.tc_show',tab_wrap).height())}})
var label_w=$('.form_style label').outerWidth()
$('.sdvig').css({marginLeft:label_w+10})
$('#image').next('a').addClass('update_captcha')
$(".table1 tr,.table2 td").mouseover(function(){$(this).addClass("over");}).mouseout(function(){$(this).removeClass("over");});$(".table1 tr:even").addClass("alt");$(".table1 tr").find('td:first').addClass('td_first')
$(".table2,.table3,.table1").wrap('<div class="table_wrap">')
$('.gallery_list').each(function(){var g_list=$(this);$('.thumbnail',g_list).each(function(){var th_item=$(this);var th_link=$('.img_link',th_item);var th_img=$('img',th_item)
var th_clone=th_img.clone().addClass('th_clone_top').css({opacity:'0.2'})
var th_clone2=th_img.clone().addClass('th_clone_bot').css({opacity:'0.2'})
th_clone.prependTo(th_link)
th_clone2.prependTo(th_link)
th_img.css({position:'relative',zIndex:'50'});})})
$('.thumbnails').each(function(){var g_wrap=$(this);g_wrap.bind('mouseenter',function(){$('.thumbnail',g_wrap).stop().animate({opacity:'0.4'},1000).bind('mouseenter',function(){$(this).stop().animate({opacity:'1'},300)}).bind('mouseleave',function(){$(this).stop().animate({opacity:'0.4'},300)})}).bind('mouseleave',function(){$('.thumbnail',g_wrap).stop().animate({opacity:'1'},1000)})})
if($('img.style2').length){$('img.style2').each(function(){var imgWrap=$('<span>').attr('class',$(this).attr('class')).addClass('img-wrap').css({width:$(this).width(),height:$(this).height(),background:'url('+$(this).attr('src')+') 50% 50% no-repeat'})
$(this).wrap(imgWrap).hide()})}
$('.content>img,.content>p>img').each(function(){var float=$(this).attr('style')
var align=$(this).attr('align')
if(float=='float: left;'||float=='float: left'||float=='float:left;'||float=='float:left'||align=='left'){$(this).addClass('imgLeft')}
if(float=='float: right;'||float=='float: right'||float=='float:right;'||float=='float:right'||align=='right'){$(this).addClass('imgRight')}})
$(window).load(function(){$('.lady_item:nth-child(3n)',$('.lady_list')).after('<hr>')
$('.lady_item',$('.lady_list')).each(function(){var lady_item=$(this);var lady_pic=$('.lady_pic',lady_item);var icon_cam=$('.icon_cam',lady_item);if(!$('.icon_cam',lady_item).length)
icon_cam=$('.icon_cam2',lady_item)
var lady_status=$('.lady_status',lady_item);var lady_nav=$('.lady_nav',lady_item)
icon_cam.show().css({left:lady_pic.position().left+3,top:lady_pic.position().top+1})
lady_status.show().css({width:lady_pic.width()})
lady_nav.show().css({width:lady_pic.width()})})
if($('.coll_h').length){var coll_h_length=$('.coll_h').length
var h=0
for(a=0;a<coll_h_length;a++){if(h<$('.coll_h').eq(a).height())
h=$('.coll_h').eq(a).height()}
$('.coll_h').animate({height:h})}
jQuery.fn.liQuotes=function(options){var o=jQuery.extend({},options);return this.each(function(){htmlreplace($(this));function htmlreplace(element){if(!element)element=document.body;var nodes=$(element).contents().each(function(){if(this.nodeType==Node.TEXT_NODE){$(this).wrap('<span class="node_t"/>');}else{htmlreplace(this);}});};$('.node_t').each(function(){var el=$(this),str=el.html(),raquo_one=/'\s/g,laquo_one=/\s'/g,raquo_two=/"\s/g,laquo_two=/\s"/g,raquo_brack_one=/'\)/g,laquo_brack_one=/\('/g,raquo_brack_two=/"\)/g,laquo_brack_two=/\("/g,raquo_tag_one=/'$/g,laquo_tag_one=/^'/g,raquo_tag_two=/"$/g,laquo_tag_two=/^"/g,raquo_one_coma=/'\,/g,raquo_one_dot=/'\./g,raquo_two_coma=/"\,/g,raquo_two_dot=/"\./g,raquo_one_colon=/'\:/g,raquo_two_colon=/"\:/g,quest_one_colon=/'\?/g,quest_two_colon=/"\?/g,exclam_one_colon=/'\!/g,exclam_two_colon=/"\!/g,semic_one_colon=/'\;/g,semic_two_colon=/"\;/g;var result=str.replace(laquo_one," &laquo;").replace(raquo_one,"&raquo; ").replace(laquo_two," &laquo;").replace(raquo_two,"&raquo; ").replace(raquo_one_coma,"&raquo;,").replace(raquo_one_dot,"&raquo;.").replace(raquo_two_coma,"&raquo;,").replace(raquo_two_dot,"&raquo;.").replace(raquo_one_colon,"&raquo;:").replace(raquo_two_colon,"&raquo;:").replace(quest_one_colon,"&raquo;?").replace(quest_two_colon,"&raquo;?").replace(exclam_one_colon,"&raquo;!").replace(exclam_two_colon,"&raquo;!").replace(laquo_brack_one,"(&laquo;").replace(raquo_brack_one,"&raquo;)").replace(laquo_brack_two,"(&laquo;").replace(raquo_brack_two,"&raquo;)").replace(laquo_tag_one,"&laquo;").replace(raquo_tag_one,"&raquo;").replace(laquo_tag_two,"&laquo;").replace(raquo_tag_two,"&raquo;").replace(semic_one_colon,"&raquo;;").replace(semic_two_colon,"&raquo;;");el.html(result);});$('.node_t').each(function(){var html=$(this).html();$(this).after(html).remove()});});};$('.q').liQuotes();})});;(function(a){a.fn.extend({actual:function(b,k){var c,d,h,g,f,j,e,i;if(!this[b]){throw'$.actual => The jQuery method "'+b+'" you called does not exist';}h=a.extend({absolute:false,clone:false,includeMargin:undefined},k);d=this;if(h.clone===true){e=function(){d=d.filter(":first").clone().css({position:"absolute",top:-1000}).appendTo("body");};i=function(){d.remove();};}else{e=function(){c=d.parents().andSelf().filter(":hidden");g=h.absolute===true?{position:"absolute",visibility:"hidden",display:"block"}:{visibility:"hidden",display:"block"};f=[];c.each(function(){var m={},l;for(l in g){m[l]=this.style[l];this.style[l]=g[l];}f.push(m);});};i=function(){c.each(function(m){var n=f[m],l;for(l in g){this.style[l]=n[l];}});};}e();j=d[b](h.includeMargin);i();return j;}});})(jQuery);