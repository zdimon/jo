<h1><?php echo __('Персональные сообщения') ?></h1>


<p><?= __('correspondent text') ?></p>
<?php include_partial('message/menu')?>


    <?php if($hot):?>
<table class="table3" width="100%" border="0" cellspacing="0" cellpadding="0">

          <?php foreach($hot as $h):?>
          <tr>
              <td>

                      <?php include_partial('global/common/user_info',array('profile'=>$h->getToUser()->getProfile(),'arrc'=>$arrc,'arrl'=>$arrl)); ?>


              </td>
              <td valign="top">

                  <br />
                  <?= format_date($h->getUpdatedAt(),'f')?>
                  <br />
                  <ul>
                  <li><?= link_to(__('Open conversation'),'message/personal_show?h='.$h->getId()) ?></li>
                  <li><?= link_to(__('Send the message'),'message/send?username='.$h->getToUser()->getUsername(),array('id'=>'l_send_message'))  ?></li>
                  </ul>
                 
              </td>
              <td>
                  <?= $h->getStatus()?> <br />
              </td>
          </tr>
         <?php endforeach;  ?>
    </table>
    <?php else: ?>
          <?= __('У вас нет сообщений') ?>
    <?php endif; ?>




