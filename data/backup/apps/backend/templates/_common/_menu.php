
<?php if ($sf_user->isAuthenticated()): ?>

<div style="display: inline-block; float: left; width: 200px">
    <a id="dialog_link"  style="display: block; width: 150px" href="<?=  url_for('@homepage') ?>" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-person" ></span><span ><?= $sf_user->getGuardUser() ?> </span></a>

</div>


<?php if($sf_user->isSuperAdmin()):?>

    <a tabindex="0" href="#search-engines" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="flat_add"><span class="ui-icon ui-icon-triangle-1-s"></span><?= __('Adding') ?></a>
    <div id="search-engines" style="display: none;">
        <ul>

            <li><a href="<?=  url_for('user/new') ?>" class="ui-state-default ui-corner-all"><?= __('Add girl') ?></a></li>
            <li><a href="<?=  url_for('news/new') ?>" class="ui-state-default ui-corner-all"><?= __('Add news') ?></a></li>

            <li><a href="<?=  url_for('testimonials/new') ?>" class="ui-state-default ui-corner-all"><?= __('Add Testimonials') ?></a></li>
        </ul>
    </div>


    <a tabindex="0" href="#content-engines" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="flat_content"><span class="ui-icon ui-icon-triangle-1-s"></span><?= __('Content') ?></a>
    <div id="content-engines" style="display: none;">
        <ul>
            <li><a  href="<?=  url_for('page/index') ?>" class="ui-state-default ui-corner-all"><?= __('Pages') ?></a></li>
            <li><a href="<?=  url_for('testimonials/index') ?>" class="ui-state-default ui-corner-all"><?= __('Testimonials') ?></a></li>
            <li><a href="<?=  url_for('news/index') ?>" class="ui-state-default ui-corner-all"><?= __('News') ?></a></li>

        </ul>
    </div>


    <a tabindex="0" href="#user-engines" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="flat_user"><span class="ui-icon ui-icon-triangle-1-s"></span><?= __('Users') ?></a>
    <div id="user-engines" style="display: none;">
        <ul>
            <li><a  href="<?=  url_for('trprofile/index') ?>" class="ui-state-default ui-corner-all"><?= __('Translate profiles') ?></a></li>
            <li><a  href="<?=  url_for('user/index') ?>" class="ui-state-default ui-corner-all"><?= __('Ankets') ?></a></li>
            <li><a  href="<?=  url_for('photo/index') ?>" class="ui-state-default ui-corner-all"><?= __('Photos') ?></a></li>
            <li><a  href="<?=  url_for('video/index') ?>" class="ui-state-default ui-corner-all"><?= __('Videos') ?></a></li>
            <li><a  href="<?=  url_for('message/index') ?>" class="ui-state-default ui-corner-all"><?= __('Messages') ?></a></li>
            <li><a  href="<?=  url_for('guarduser/index') ?>" class="ui-state-default ui-corner-all"><?= __('Permissions') ?></a></li>
        </ul>
    </div>


    <a tabindex="0" href="#setting-engines" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="flat_setting"><span class="ui-icon ui-icon-triangle-1-s"></span><?= __('Settings') ?></a>
    <div id="setting-engines" style="display: none;">
        <ul>
            <li><a  href="<?=  url_for('settings/index') ?>" class="ui-state-default ui-corner-all"><?= __('Site') ?></a></li>
            <li><a  href="<?=  url_for('notify/index') ?>" class="ui-state-default ui-corner-all"><?= __('Notice') ?></a></li>
            <li><a  href="<?=  url_for('profile_packet/index') ?>" class="ui-state-default ui-corner-all"><?= __('Membership') ?></a></li>
        </ul>
    </div>


    <a tabindex="0" href="#setting-letter" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="flat_letter"><span class="ui-icon ui-icon-triangle-1-s"></span><?= __('Letters') ?></a>
    <div id="setting-letter" style="display: none;">
        <ul>
            <li><a  href="<?=  url_for('newuserletter/index') ?>" class="ui-state-default ui-corner-all"><?= __('Newsletter') ?></a></li>
            <li><a  href="<?=  url_for('mailer/index') ?>" class="ui-state-default ui-corner-all"><?= __('Sending') ?></a></li>
        </ul>
    </div>

    <a tabindex="0" href="#setting-letter" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="flat_forum"><span class="ui-icon ui-icon-triangle-1-s"></span><?= __('Forum') ?></a>
    <div id="setting-letter" style="display: none;">
        <ul>
            <li><a  href="<?=  url_for('forum_category/index') ?>" class="ui-state-default ui-corner-all"><?= __('Categories') ?></a></li>
            <li><a  href="<?=  url_for('forum_topic/index') ?>" class="ui-state-default ui-corner-all"><?= __('Topics') ?></a></li>
        </ul>
    </div>


    <a tabindex="0" href="#setting-chat" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="flat_chat"><span class="ui-icon ui-icon-triangle-1-s"></span><?= __('Chat') ?></a>
    <div id="setting-chat" style="display: none;">
        <ul>
            <li><a  href="<?=  url_for('chat_chanel/index') ?>" class="ui-state-default ui-corner-all"><?= __('Video chanels') ?></a></li>
            <li><a  href="<?=  url_for('chat_room/index') ?>" class="ui-state-default ui-corner-all"><?= __('Users rooms') ?></a></li>
        </ul>
    </div>


    <?php elseif($sf_user->hasCredential('redaktor')):?>
        <a tabindex="0" href="<?=  url_for('trprofile/index') ?>" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" ><?= __('Translate profiles') ?></a>
        <a tabindex="0" href="<?=  url_for('notify/index') ?>" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" ><?= __('Translate notice') ?></a>
        <a tabindex="0" href="<?=  url_for('page/index') ?>" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" ><?= __('Pages') ?></a>


    <?php endif ?>



<div style="float: right">

    <a  style="display: block; width: 100px" href="<?=  url_for('@sf_guard_signout') ?>" id="dialog_link" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-power"></span><?= __('Exit') ?></a>
</div>

<?php endif ?>