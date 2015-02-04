<h1><?php echo __('Исходящие сообщения') ?></h1>


<?php include_partial('message/menu')?>
<?php include_partial('message/filter_out')?>
<div style="clear: both"></div>
<?php if(!$pager->getNbResults()):?>
        <div class="alert_error" align="center">
            <?= __('No data')  ?>
        </div>
<?php else: ?>

        <table class="table3" width="100%" border="0" cellspacing="0" cellpadding="0">
          <thead>
            <th colspan="4" align="center">

              <?php echo pager_navigation($pager, url_for('message/out'),array('alias')) ?>


            </th>
          </thead>
          <tbody>
            <?php foreach ($pager->getResults() as $message): ?>
            <tr>
              <td>
                  <?= include_partial('global/common/user_info',array('profile'=>$message->getToUser()->getProfile(),'arrc'=>$arrc,'arrl'=>$arrl)) ?>

              </td>
              <td valign="top" style="padding-top: 10px">
                  <p><?php echo $message->getContent() ?></p>
              </td>
              <td><?php echo format_date($message->getCreatedAt(),'D') ?></td>
              <td>

                  <?php echo link_to(__('Написать еще'),'message/send?username='.$message->getToUser()->getUsername(),array('title'=>__('Написать еще'))) ?>

              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <?php echo pager_navigation($pager, url_for('message/out'),array('alias')) ?>

<?php endif; ?>