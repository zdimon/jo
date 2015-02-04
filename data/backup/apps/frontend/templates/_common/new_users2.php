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
    ->orderBy('a.rating DESC')
    ->limit(4)
    ->offset(4);

if ($sf_user->isAuthenticated())
{
    //$q->addWhere('a.gender=?',array($sf_user->getGuardUser()->getAntiGender()));
}
$items = $q->execute();
?>


    <?php foreach($items as $i): ?>

        <div class="lady_item">
            <div class="lady_item_left">

                <a title="<?= $i->getImgSeo() ?>" href="<?= url_for('search/index?order=rating')?>"><img src="<?= $i->getUrlImageMiddle() ?>"></a>
                <img class="icon_new" src="/pic/icon_new.png">

            </div>

        </div>

    <?php endforeach?>

<div style="clear: both;"></div>


