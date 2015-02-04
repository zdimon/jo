<!doctype html>
<html lang="en">
<head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <link rel="image_src" href="pic/expres_icon.jpg" />
    <!--[if IE 6]><script src="js/DD_belatedPNG_0.0.8a-min.js"></script><script>DD_belatedPNG.fix('.png, img');</script><![endif]-->
    <!--[if IE]><script>document.createElement('header');document.createElement('nav');document.createElement('section');document.createElement('article');document.createElement('aside');document.createElement('footer');</script><![endif]-->
</head>
<body>

<div class="header_bg" id="wrapper">
    <div class="site_size">
        <header>
            <div id="header">
                <a href="<?= url_for('mainpage/index') ?>"><img src="/pic/logo.png" alt="" class="logo"></a>
                <div align="center"><?php  include_partial('global/common/lang_panel')?></div>
                <div class="slide_bg">
                    <div class="slide_poss">
                        <?php  include_partial('global/common/topheader') ?>

                    </div><!-- .slide_poss-->
                </div><!-- .slide_bg-->
            </div><!-- #header-->
        </header>
        <div id="conteiner">
            <div class="center_coll">
                <div class="center_coll_size">
                    <div class="coll_h content png">
                        <?php include_partial('global/common/alert')?>
                        <?php echo $sf_content ?>

                    </div><!-- .content-->
            </div><!-- .center_coll_size-->
        </div><!-- .center_coll-->
        <div class="png coll_h left_coll">

            <div class="coll_size">
                <?php if ($sf_user->isAuthenticated() and $sf_user->getGuardUser()->getProfile()->getIsActive()): ?>
                  <?php // include_partial('global/common/forms/login_form')?>


                    <div align="center"><span class="but_2_wrap block"><span class="but_2 block"><?= __('New Members')?></span></span></div>
                    <div class="lady_list_coll">

                        <?php  include_partial('global/common/new_users3',array()) ?>
                        <div align="center"><span class="but_2_wrap block"><span class="but_2 block"><?= __('Anniversary')?></span></span></div>
                        <?php  include_partial('global/common/adv_users',array()) ?>
                    </div><!-- .lady_list_coll-->
                <?php endif ?>

            </div><!-- .coll_size-->
        </div><!-- .left_coll-->
        <div class="png coll_h right_coll">
          <?php if ($sf_user->isAuthenticated() and $sf_user->getGuardUser()->getProfile()->getIsActive()): ?>
            <div class="coll_size">
                <div align="center"><span class="but_2_wrap block "><span class="but_2 block"><?= __('Quick Search')?></span></span></div>
                <?php  include_partial('global/common/forms/short_search_form',array('form'=> new qsearchForm())) ?>

                <div align="center"><span class="but_2_wrap block"><span class="but_2 block"><?= __('Most Viewed')?></span></span></div>
                <div class="lady_list_coll">
                    <?php  //include_partial('global/common/adv_users2',array()) ?>
                    <?php  include_partial('global/common/new_users2',array()) ?>
                </div><!-- .lady_list_coll-->
                <h2><?= __('Visit Ukraine')?></h2>
                <p align="center"><a href="#"><img width="100%" src="/pic/icon_map.png"></a></p>
                <h2><?= __('Visit Russia')?></h2>
                <p align="center"><a href="#"><img width="100%" src="/pic/icon_map_2.png"></a></p>
            </div><!-- .coll_size-->
            <?php endif ?>
        </div><!-- .right_coll-->
        <div class="clear"></div>
    </div><!-- #conteiner-->
</div>
</div><!-- .header_bg #wrapper-->
<footer id="footer">
    <div class="site_size">
        <div align="center" class="footer_center_ind">
            Copyright © 2012 Our-feeling
        </div><!-- .footer_center_ind-->
    </div><!-- #footer-->
</footer><!-- #footer-->
<div class="menu_left_poss" style="position:absolute; top:100px; left:0">
    <?php include_partial('global/common/top_menu')?>

</div>


<?php if ($sf_user->isAuthenticated()): ?>
    <?php

    echo jq_periodically_call_remote(array(
        'frequency' => 10,
        'update' => 'message_block',
        'script'=>true,
        'method'=>'GET',
        'url' => url_for('message/check'),
    ))
    ?>


    <?php

    echo jq_periodically_call_remote(array(
        'frequency' => 10,
        'update' => 'chat_call',
        'loading' => '$("#loading").show()',
        'complete' => '$("#loading").hide()',
        'script'=>true,
        'method'=>'GET',
        'url' => url_for('chat/call'),
    ))
    ?>
        <?php endif; ?>
<div id="chat_call"> </div>
<div id="message_block"></div>
<div class="newEnterSite"></div>

<div class="newEnterSite2"></div>
<script type="text/javascript" src="/js/awstats_misc_tracker.js"></script>
</body>

</html>