<?php $profile = $u->getProfile(); ?>

<?php if($profile): ?>

  <?php $arrc = sfCultureInfo::getInstance($sf_user->getCulture())->getCountries()?>
        <?php $profile->getGenderImage() ?><?= __('ID') ?>: <?= $profile->getUserId() ?> <br />
        <?= __('Login') ?>: <?= $profile->getsfGuardUser()->getUsername() ?><br />

        <?= __('First name') ?>: <?= $profile->getFirstName() ?><br />
        <?= __('Last name') ?>: <?= $profile->getLastName() ?><br />
        <?= __('Age') ?>: <?= $profile->getAge() ?><br />
        <?= __('Country') ?>: <?= $arrc[$profile->getCountry()] ?><br />
        <?= __('City') ?>: <?= $profile->getCity() ?><br />
        <?= __('Status') ?>: <?= $profile->getStatus() ?><br />


    <?php if($profile->getGender()=='w' and $profile->getPartnerId()>0 and $sf_user->hasCredential('admin') and sfConfig::get('app_menu_partner')!='false'): ?>
         <br />
     <a target="_blank" href="<?= url_for('partner/show_from_pid?id='.$profile->getPartnerId()) ?>" id="dialog_link" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-contact"></span><?= __('Agency').' ID:'.$profile->getPartnerId() ?></a>
     <?php endif ?>
     
       
<?php else: ?>
        <span style="color: red"> Ошибка, <?= $u->getUsername().'['.$u->getId().']' ?>no profile!</span>
<?php endif ?>

