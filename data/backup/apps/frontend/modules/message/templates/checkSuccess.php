<?php if($mes): ?>
<script type="text/javascript">
        <?php
        if($mes->getFromUser()->getProfile()->getGender()=='m')
        {
            $who = __('He');
            $whom = __('him');
        }
        else
        {
            $who = __('She');
            $whom = __('her');
        }
        ?>
    //start newEnterSite
    var newEnterSite = $('.newEnterSite');
    //setInterval(startFunck, 2000)
    startFunck();
    function startFunck(){

        var visItemTitleText = '<?= __('popup Receive an email from %1% maybe is important go to read  Letter',array('%1%'=>$mes->getFromUser()->getProfile()->getFirstName().' '.$mes->getFromUser()->getProfile()->getLastName())) ?>';
        var visItemAttentionText = 'ID <?= $mes->getFromId() ?>';
        var visItemDescrText = '<?= link_to(__('Mailbox'),'message/index') ?> <br/><br/> <?= link_to(__('Read letter'),'message/show?id='.$mes->getId()) ?> ';
        var visItemPhotoPic = '<img src="<?= $mes->getFromUser()->getProfile()->getUrlImageMiddle() ?>">'

        var visItem = $('<div>').addClass('newVisItem').hide();

        var visItemTitle = $('<div>').html(visItemTitleText).addClass('visItemTitle').appendTo(visItem);
        var visItemAttention = $('<div>').html(visItemAttentionText).addClass('visItemAttention').appendTo(visItem);

        var visItemPhoto = $('<div>').html(visItemPhotoPic).addClass('visItemPhoto').appendTo(visItem);
        var visItemDescr = $('<div>').html(visItemDescrText).addClass('visItemDescr').appendTo(visItem);

        visItem.appendTo(newEnterSite);

        var newVisItem = $('.newVisItem');
        var newVisItemHeight = newVisItem.actual('outerHeight');
        newVisItem.css({bottom:'-'+newVisItemHeight+'px'}).show().animate({bottom:'0'});

     //   function newVisItemRemove(){
      //      newVisItem.fadeOut(function(){$(this).remove()})
     //   }
       // setTimeout(newVisItemRemove,4000)
    }
    //end newEnterSite
</script>
<?php endif; ?>




<?php if($fav): ?>
<script type="text/javascript">
        <?php
        if($fav->getUser()->getProfile()->getGender()=='m')
        {
            $who = __('woman');
            $whom = __('him');
        }
        else
        {
            $who = __('man');
            $whom = __('her');
        }
        ?>
    //start newEnterSite
    var newEnterSite = $('.newEnterSite');
    //setInterval(startFunck, 2000)
    startFunck();
    function startFunck(){

        var visItemTitleText = '<?= __('popup You are lucky! %2% added you to favorite, go NOW to contact or write to %1%! If you forget to do another can do that at your place.',array('%1%'=> $fav->getUser()->getProfile()->getFirstName().' '.$fav->getUser()->getProfile()->getLastName(),'%2%'=>$fav->getUser()->getProfile()->getFirstName().' '.$fav->getUser()->getProfile()->getLastName()))?>';
        var visItemAttentionText = 'ID <?= $fav->getUserId() ?>';
        var visItemDescrText = '<?= link_to(__('Favorites'),'friend/my') ?>';
        var visItemPhotoPic = '<img src="<?= $fav->getUser()->getProfile()->getUrlImageMiddle() ?>">'

        var visItem = $('<div>').addClass('newVisItem').hide();

        var visItemTitle = $('<div>').html(visItemTitleText).addClass('visItemTitleFav').appendTo(visItem);
        var visItemAttention = $('<div>').html(visItemAttentionText).addClass('visItemAttention').appendTo(visItem);

        var visItemPhoto = $('<div>').html(visItemPhotoPic).addClass('visItemPhoto').appendTo(visItem);
        var visItemDescr = $('<div>').html(visItemDescrText).addClass('visItemDescr').appendTo(visItem);

        visItem.appendTo(newEnterSite);

        var newVisItem = $('.newVisItem');
        var newVisItemHeight = newVisItem.actual('outerHeight');
        newVisItem.css({bottom:'-'+newVisItemHeight+'px'}).show().animate({bottom:'0'});

        //   function newVisItemRemove(){
        //      newVisItem.fadeOut(function(){$(this).remove()})
        //   }
        // setTimeout(newVisItemRemove,4000)
    }
    //end newEnterSite
</script>
<?php endif; ?>




<?php if($int): ?>
<script type="text/javascript">
        <?php
        if($int->getUser()->getProfile()->getGender()=='m')
        {
            $who = __('woman');
            $whom = __('him');
        }
        else
        {
            $who = __('man');
            $whom = __('her');
        }
        ?>
    //start newEnterSite
    var newEnterSite = $('.newEnterSite');
    //setInterval(startFunck, 2000)
    startFunck();
    function startFunck(){

        var visItemTitleText = '<?= __('popup You are lucky! %1% sent you interest, go NOW to contact or write to %2%! If you forget to do another can do that at your place.',array('%1%'=>$int->getUser()->getProfile()->getFirstName().' '.$int->getUser()->getProfile()->getLastName(),'%2%'=>$int->getUser()->getProfile()->getFirstName().' '.$int->getUser()->getProfile()->getLastName()))?>';
        var visItemAttentionText = 'ID <?= $int->getUserId() ?>';
        var visItemDescrText = '<?= link_to(__('Who interested me'),'interest/index') ?>';
        var visItemPhotoPic = '<img src="<?= $int->getUser()->getProfile()->getUrlImageMiddle() ?>">'

        var visItem = $('<div>').addClass('newVisItem').hide();

        var visItemTitle = $('<div>').html(visItemTitleText).addClass('visItemTitleInt').appendTo(visItem);
        var visItemAttention = $('<div>').html(visItemAttentionText).addClass('visItemAttention').appendTo(visItem);

        var visItemPhoto = $('<div>').html(visItemPhotoPic).addClass('visItemPhoto').appendTo(visItem);
        var visItemDescr = $('<div>').html(visItemDescrText).addClass('visItemDescr').appendTo(visItem);

        visItem.appendTo(newEnterSite);

        var newVisItem = $('.newVisItem');
        var newVisItemHeight = newVisItem.actual('outerHeight');
        newVisItem.css({bottom:'-'+newVisItemHeight+'px'}).show().animate({bottom:'0'});

        //   function newVisItemRemove(){
        //      newVisItem.fadeOut(function(){$(this).remove()})
        //   }
        // setTimeout(newVisItemRemove,4000)
    }
    //end newEnterSite
</script>
<?php endif; ?>




<?php if($viw): ?>
    <?php
    if($viw->getUser()->getProfile()->getGender()=='m')
    {
        $who = __('He');
        $whom = __('him');
    }
    else
    {
        $who = __('She');
        $whom = __('her');
    }
        ?>
<script type="text/javascript">

    //start newEnterSite
    var newEnterSite = $('.newEnterSite');
    //setInterval(startFunck, 2000)
    startFunck();
    function startFunck(){

        var visItemTitleText = '<?= __('popup %1% visit your profile go to tell to %2% Hello maybe %3% wait it?',array('%1%'=>$viw->getUser()->getProfile()->getFirstName().' '.$viw->getUser()->getProfile()->getLastName(),'%2%'=>$viw->getUser()->getProfile()->getFirstName().' '.$viw->getUser()->getProfile()->getLastName(),'%3%'=>$viw->getUser()->getProfile()->getFirstName().' '.$viw->getUser()->getProfile()->getLastName()))?>';
        var visItemAttentionText = 'ID <?= $viw->getUserId() ?>';
        var visItemDescrText = '<?= link_to(__('Who viewed me'),'viewed/index') ?>';
        var visItemPhotoPic = '<img src="<?= $viw->getUser()->getProfile()->getUrlImageMiddle() ?>">'

        var visItem = $('<div>').addClass('newVisItem').hide();

        var visItemTitle = $('<div>').html(visItemTitleText).addClass('visItemTitleViw').appendTo(visItem);
        var visItemAttention = $('<div>').html(visItemAttentionText).addClass('visItemAttention').appendTo(visItem);

        var visItemPhoto = $('<div>').html(visItemPhotoPic).addClass('visItemPhoto').appendTo(visItem);
        var visItemDescr = $('<div>').html(visItemDescrText).addClass('visItemDescr').appendTo(visItem);

        visItem.appendTo(newEnterSite);

        var newVisItem = $('.newVisItem');
        var newVisItemHeight = newVisItem.actual('outerHeight');
        newVisItem.css({bottom:'-'+newVisItemHeight+'px'}).show().animate({bottom:'0'});

        //   function newVisItemRemove(){
        //      newVisItem.fadeOut(function(){$(this).remove()})
        //   }
        // setTimeout(newVisItemRemove,4000)
    }
    //end newEnterSite
</script>
<?php endif; ?>







<?php if($mat): ?>
<script type="text/javascript">

    //start newEnterSite
    var newEnterSite = $('.newEnterSite');
    //setInterval(startFunck, 2000)
    startFunck();
    function startFunck(){

        var visItemTitleText = '<?= $mat->getUser()->getProfile()->getFirstName() ?> <?= $mat->getUser()->getProfile()->getLastName() ?> <?=__('match to you!')?>';
        var visItemAttentionText = 'ID <?= $mat->getUserId() ?>';
        var visItemDescrText = '<?= link_to(__('My profile'),'profile/my') ?>';
        var visItemPhotoPic = '<img src="<?= $mat->getUser()->getProfile()->getUrlImageMiddle() ?>">'

        var visItem = $('<div>').addClass('newVisItem').hide();

        var visItemTitle = $('<div>').html(visItemTitleText).addClass('visItemTitleFav').appendTo(visItem);
        var visItemAttention = $('<div>').html(visItemAttentionText).addClass('visItemAttention').appendTo(visItem);

        var visItemPhoto = $('<div>').html(visItemPhotoPic).addClass('visItemPhoto').appendTo(visItem);
        var visItemDescr = $('<div>').html(visItemDescrText).addClass('visItemDescr').appendTo(visItem);

        visItem.appendTo(newEnterSite);

        var newVisItem = $('.newVisItem');
        var newVisItemHeight = newVisItem.actual('outerHeight');
        newVisItem.css({bottom:'-'+newVisItemHeight+'px'}).show().animate({bottom:'0'});

        //   function newVisItemRemove(){
        //      newVisItem.fadeOut(function(){$(this).remove()})
        //   }
        // setTimeout(newVisItemRemove,4000)
    }
    //end newEnterSite
</script>
<?php endif; ?>