<h3><?= __('Contact Us') ?></h3>



<?= $page->getIcontent() ?>

<?php foreach ($pager->getResults() as $i): ?>

<div class="hr"> </div>
<p> <?= $i->getBody()?></p>
<p><b><?= $i->getName()?> </b> </p>

<?php endforeach; ?>

<?php echo pager_navigation($pager, url_for('testimonials/index')) ?>

<div class="hr"> </div>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<!-- ourfeling8 -->

<ins class="adsbygoogle"

     style="display:inline-block;width:300px;height:250px"

     data-ad-client="ca-pub-6382580135773552"

     data-ad-slot="8412723022"></ins>

<script>

(adsbygoogle = window.adsbygoogle || []).push({});

</script>


<h3> <?= __('Send your message') ?></h3>

<form  enctype="multipart/form-data" method="post" class="form_style" action="<?= url_for('contact/index') ?>">

<?php echo $form ?>

    <div class="row" align="center">
       <input class="but" type="submit" value="<?= __('Send message') ?>" />
    </div>

</form>

<?php if (!$sf_user->isAuthenticated()): ?>
<?php include_partial('global/common/forms/popup_register_form') ?>
<?php endif; ?>



<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<!-- ourfeling8 -->

<ins class="adsbygoogle"

     style="display:inline-block;width:300px;height:250px"

     data-ad-client="ca-pub-6382580135773552"

     data-ad-slot="8412723022"></ins>

<script>

(adsbygoogle = window.adsbygoogle || []).push({});

</script>
