<h1><?php echo __('Входящие сообщения') ?></h1>


<?php include_partial('message/menu')?>
<?php include_partial('message/filter_in')?>
<div style="clear: both"></div>
<?php if(!$pager->getNbResults()):?>
        <div class="alert_error" align="center">
            <?= __('No data')  ?>
        </div>

<?php else: ?>
     <form method="POST" class="form_style" action="<?= url_for('message/delto') ?>">
        <table class="table3" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th><input name="se" class="all"  type="checkbox"></th>
                <th colspan="4" align="center">

                        <?php echo pager_navigation($pager, url_for('message/index'),array('alias')) ?>




                </th>

            </tr>
           <?php foreach ($pager->getResults() as $message): ?>
            <tr>
                <td width="1%"><input name="sel[]" type="checkbox" value="<?= $message->getId() ?>"></td>
                <td width="1%" style="padding-top:5px; padding-bottom:5px;">

                    <?= include_partial('global/common/user_info',array('profile'=>$message->getFromUser()->getProfile(),'arrc'=>$arrc,'arrl'=>$arrl)) ?>

                </td>
                <td style="padding-top:5px; padding-bottom:5px; text-align:left">
                    <?php echo $message->getLinkTitle() ?>
                </td>

                <td style="white-space: nowrap;"><?php echo format_date($message->getCreatedAt(),'D') ?></td>
                <td align="center" width="1%">
                    <?php echo link_to(__('Ответить'),'message/send?reply_id='.$message->getId().'&username='.$message->getFromUser()->getUsername(),array('title'=>__('Ответить'))) ?>
                    <?php echo link_to(__('Удалить'),'message/delto?id='.$message->getId(),array('title'=>__('Удалить'),'confirm'=>__('Вы уверены?'))) ?>
                </td>
            </tr>
            <?php endforeach; ?>

            <tr>
                <th>&nbsp;</th>
                <th colspan="4" align="center">
                    <?php echo pager_navigation($pager, url_for('message/index'),array('alias')) ?>
                </th>

            </tr>
        </table>
         <input type="submit" class="but" value="<?= __('Удалить выбранное') ?>">
     </form>
    <?php endif; ?>




