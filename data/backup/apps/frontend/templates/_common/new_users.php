<?php



if($sf_user->isAuthenticated())
{
    if($sf_user->getGuardUser()->getGender()=='m')
    {
        $items = ProfileTable::getAnniversaries('w');
    }
    else
    {
        $items = ProfileTable::getAnniversaries('m');
    }
}
else
{
    $items = ProfileTable::getAnniversaries('w');
}

?>


    <?php foreach($items as $i): ?>

        <div class="lady_item">
            <div class="lady_item_left">
                <a href="<?= url_for('search/anniversary')?>"><img src="<?= $i->getUrlImageMiddle() ?>"></a>
            </div>
        </div>

    <?php endforeach?>

<div style="clear: both;"></div>


