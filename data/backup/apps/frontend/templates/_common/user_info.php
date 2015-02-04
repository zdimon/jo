<div class="lady_item">
    <div class="lady_item_left">
        <a href="<?= url_for('profile/show?username='.$profile->getsfGuardUser()->getUsername())?>"><img src="<?= $profile->getUrlImageMiddle() ?>"></a>
    </div>
    <div class="lady_item_right">
        <a href="#" class="lady_name"><?= $profile->getFirstName() ?> <?= $profile->getLastName() ?></a>
        <div class="pb10">ID:<?= $profile->getUserSpecId() ?></div>
        <div><?= __('Age')?>: <?= $profile->getAge() ?></div>
        <div><?= __('Height')?>: <?= $profile->getHeight() ?> cm</div>
        <div><?= __('Weight')?>: <?= $profile->getWeight() ?> kg</div>
        <div> <?= $arrc[$profile->getCountry()] ?>, <?= $profile->getCity() ?></div>
    </div>
</div>