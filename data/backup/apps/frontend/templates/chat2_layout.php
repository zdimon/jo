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
    <script type="text/javascript" src="/js/sm.js"></script>
    <script type="text/javascript" src="/js/jquery.scrollTo-min.js"></script>
    <script type="text/javascript" src="/js/swfobject.js"></script>
</head>
<body>



          <table style="margin: 10px">
              <tr>
                  <td width="20"></td>
                  <td>
                      <!-- Подключаем входящую камеру  мужика -->
                      <div id="man_camera_loading" class="loading"> <?= __('Загрузка') ?>....</div>
                      <div id="man_camera_in_block">
                          <?php if($sf_user->getGuardUser()->getGender()=='m') include_component('chat','show_man_video_in')?>
                      </div>
                      <!--   /////////////////////    -->
                      <!-- Подключаем выходящую камеру  мужика -->
                      <div id="man_camera_out_block">
                          <?php if($sf_user->getGuardUser()->getGender()=='w') include_component('chat','show_man_video_out')?>
                      </div>
                      <!--   /////////////////////    -->
                  </td>
                  <td width="20"></td>
                  <td>
                      <!-- Подключаем камеры -->
                      <?php if($sf_user->getGuardUser()->getGender()=='w') include_component('chat','show_woman_video_in')?>

                      <?php if($sf_user->getGuardUser()->getGender()=='m'): ?>
                      <div id="chat_video_out">

                          <div align="center"><?= image_tag('/images/icons/no_video.jpg') ?></div>
                          <div align="center" style="color: white"><?= __('Загрузка...') ?></div>

                      </div>
                      <?php endif; ?>

                  </td>
                  <td width="20"></td>
                  <td style="text-wrap: none;">
                      <?php if($sf_user->getGuardUser()->getGender()=='m' and $sf_user->getGuardUser()->getProfile()->getPacketId()<4 ):?>

                           <span style=" width: 100px; color: #DD843B; font-size: 12px"><?= __('On your account') ?>: <div style="display: inline-block; font-size: 16px; font-weight: bold;" id="chat_account"><?= $sf_user->getGuardUser()->getAccount() ?></div> <?= __('cretit(s)') ?></span>

                      <?php endif; ?>
                  </td>

              </tr>
              </table>
              <table>
              <tr>
                  <td>
                      <?php include_partial('global/common/alert')?>
                      <?php echo $sf_content ?>

                  </td>
                  <td valign="top">


                      <?php if ($sf_user->isAuthenticated() and $sf_user->getGuardUser()->getProfile()->getIsActive()): ?>
                      <div class="coll_size">

                          <!-- Подключаем контакты -->
                          <div id="chat_contact_list"></div>
                          <!--   /////////////////////    -->

                      </div><!-- .coll_size-->
                      <?php endif ?>


                  </td>
              </tr>

          </table>











</body>

</html>