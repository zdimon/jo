<?php


if($sf_user->isAuthenticated())
{
    if($sf_user->getGuardUser()->getGender()=='m')
    {
        $gen = 'w';
    }
    else
    {
        $gen = 'm';
    }
}
else
{
    $gen = 'w';
}


$q= Doctrine::getTable('Profile')
    ->createQuery('a')
    ->where('a.is_active=? and a.status_id=1 and a.with_photo=? and a.gender=?',array(true,true,$gen))
    ->orderBy('a.id DESC')
    ->limit(4);

if ($sf_user->isAuthenticated())
{
    //$q->addWhere('a.gender=?',array($sf_user->getGuardUser()->getAntiGender()));
}
$items = $q->execute();
?>


    <?php foreach($items as $i): ?>

        <div class="lady_item">
            <div class="lady_item_left">
                <a title="<?= $i->getImgSeo() ?>" href="<?= url_for('search/index?new=true')?>"><img src="<?= $i->getUrlImageMiddle() ?>"></a>
            </div>

        </div>

    <?php endforeach?>

<div style="clear: both;"></div>


