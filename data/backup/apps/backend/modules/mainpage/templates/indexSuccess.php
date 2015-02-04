<?php include_partial('global/assets') ?>
<h1> <?= __('Main page')  ?></h1>

<?php if($sf_user->isSuperAdmin()):?>

<div style="font-size: 12px" id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
    <div class="fg-toolbar ui-widget-header ui-corner-all">
        <h1> <?= __('Users')  ?></h1>
    </div>


    <br />

    <a  style="display: inline-block; width: 170px" href="<?= url_for('user/filterOnapprove')?>" id="dialog_link" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-check"></span><?= __('No authorisated') ?> (<?= ProfileTable::getCntNoapprove() ?>)</a>


    <a  style="display: inline-block;  width: 120px" href="<?= url_for('user/filterMan')?>" id="dialog_link" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-person"></span><?= __('Men') ?> (<?= ProfileTable::getCntMans() ?>)</a>

    <a  style="display: inline-block;  width: 120px" href="<?= url_for('user/filterWoman')?>" id="dialog_link" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-person"></span><?= __('Woman') ?> (<?= ProfileTable::getCntWomans() ?>)</a>


    <br />
    <br />

    <?php endif; ?>




