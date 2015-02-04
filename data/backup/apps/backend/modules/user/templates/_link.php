
  <!--   <?= link_to(__('Messages'),'user/filterMessage?id='.$profile->getUserId()) ?> <br /> -->

<?php if($profile->getGender()=='w'): ?>
<p><a style="display: block; width: 160px; margin-bottom: 2px" target="_blank" href="<?= url_for('message/filterSend?id='.$profile->getUserId()) ?>" id="dialog_link" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-arrowreturnthick-1-e"></span><?= __('Letters (sent)') ?></span></a></p>
<p><a style="display: block; width: 160px; margin-bottom: 2px" target="_blank" href="<?= url_for('message/filterRecive?id='.$profile->getUserId()) ?>" id="dialog_link" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-arrowreturnthick-1-w"></span><?= __('Letters (resived)') ?></span></a></p>
<?php endif ?>
     


<?php if($profile->getGender()=='m'): ?>
<p><?= link_to(__('Letters (sent)'),'message/filterSend?id='.$profile->getUserId()) ?> </p>
<p><?= link_to(__('Letters (read)'),'message/filterRead?id='.$profile->getUserId()) ?> </p>
<!--<p><?= link_to(__('Letters (not approved)'),'gift_order/filterVideo?id='.$profile->getUserId()) ?> </p>-->
<?php endif ?>