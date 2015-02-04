<h1><?= __('Black list') ?></h1>



<table class="table3" width="100%" border="0" cellspacing="0" cellpadding="0">
    <tbody>
    <?php foreach ($pager->getResults() as $friend): ?>
    <tr>
        <td>
            <?= include_partial('global/common/user_info',array('profile'=>$friend,'arrc'=>$arrc,'arrl'=>$arrl)) ?>
        </td>

    </tr>
        <?php endforeach; ?>
    </tbody>
    <tr>
        <th colspan="2" align="center">
            <?php echo pager_navigation($pager, url_for('scamer/index'),array('alias')) ?>
        </th>
    </tr>
</table>


    <form class="form_style"  action="<?php echo url_for('scamer/index') ?>" method="POST">

        <?php echo $form ?>

        <div class="row input_but" align="center">
            <input class="but" type="submit" value="<?php echo __('Send') ?>" />
        </div>

    </form>



