
<div class="lady_item">
    <div class="lady_item_left">
         <?php if($profile->getIsCamera()):?>
           <span class="icon_cam2"></span>
         <?php endif; ?>

        <a href="<?= url_for('profile/show?username='.$profile->getsfGuardUser()->getUsername()) ?>"><img class="lady_pic" title="<?= $profile->getImgSeo() ?>" src="<?= $profile->getUrlImageMiddle() ?>" alt="<?= $profile->getsfGuardUser()->getRealName() ?>"></a>
        <div class="lady_status">
          <?php if($profile->getsfGuardUser()->getIsOnline()):?>
             <span class="blink" style="color: green; text-decoration:blink"><?= __('Online') ?></span>
          <?php else: ?>
            <?= __('Offline') ?>
          <?php endif; ?>
        </div>
        <div class="png lady_nav">
            <a title="<?= __('Send message') ?>" href="<?= url_for('message/send?username='.$profile->getsfGuardUser()->getUsername())?>"><img src="/pic/icon_nav_2.png"></a>
            <a title="<?= __('Add to favorite') ?>" href="<?= url_for('friend/add?username='.$profile->getsfGuardUser()->getUsername())?>"><img src="/pic/icon_nav_1.png"></a>
            <?php if($profile->getWithVideo()): ?>
                <a title="<?= __('Show video') ?>" href="<?php echo url_for('profile/showvideo?id='.$profile->getUserId()) ?>"><img src="/pic/icon_nav_3.png"></a>
             <?php endif; ?>
            <a title="<?= __('Send interest') ?>" href="<?= url_for('interest/add?username='.$profile->getsfGuardUser()->getUsername())?>"><img src="/pic/icon_nav_4.png"></a>
            <a title="<?= __('Send gift') ?>" href="#"><img src="/pic/icon_nav_5.png"></a>
        </div>
    </div>
    <div class="lady_item_right">
        <a href="<?= url_for('profile/show?username='.$profile->getsfGuardUser()->getUsername()) ?>" class="lady_name"><?= $profile->getFirstName() ?> <?= $profile->getLastName() ?></a>
        <div class="pb10"><b>ID:<?= $profile->getUserSpecId() ?></b></div>

        <?php if($profile->getIsChat())
        {
            $imc = 'icon_chat.png';
        }
        else
        {
            $imc = 'icon_chat2.png';
        }
        ?>

        <div class="chat_but">
            <a title="<?= __('Chat Now') ?>" onClick="window.open('<?= url_for('chat/dispatcher?user_id='.$profile->getUserId()) ?>','chatwindow','width=700,height=600')" href="#" ><img src="/pic/<?= $imc ?>" class="middle"></a>
            <a title="<?= __('Chat Now') ?>" onClick="window.open('<?= url_for('chat/dispatcher?user_id='.$profile->getUserId()) ?>','chatwindow','width=700,height=600')" href="#" ><?= __('Chat Now') ?></a>
        </div>


        <table style="box-shadow: 4px 4px 4px #2D2721;">
            <tr>
                <td style="padding:2px; border: 1px solid white"><b><?= __('Age') ?>:</b></td>
                <td style="padding:2px; border: 1px solid white"><?= $profile->getAge() ?></td>
            </tr>
            <tr>
                <td style="padding:2px; border: 1px solid white"><b><?= __('Height') ?>:</b></td>
                <td style="padding:2px; border: 1px solid white"><?= $profile->getHeight() ?></td>
            </tr>
            <tr>
                <td style="padding:2px; border: 1px solid white"><b><?= __('Weight') ?>:</b></td>
                <td style="padding:2px; border: 1px solid white"><?= $profile->getWeight() ?></td>
            </tr>
            <tr>
                <td style="padding:2px; border: 1px solid white"><b><?= __('City') ?>:</b></td>
                <td style="padding:2px; border: 1px solid white"><?= $profile->getCity() ?></td>
            </tr>
            <tr>
                <td style="padding:2px; border: 1px solid white"><b><?= __('Country') ?>:</b></td>
                <td style="padding:2px; border: 1px solid white"><?= $arrc[$profile->getCountry()] ?></td>
            </tr>
        </table>



    </div>
</div>



                      
