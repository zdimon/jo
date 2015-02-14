<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<h3><?= __('Suggestions') ?></h3>
<?php if($page): ?>
<p>
    <?= $page->getIcontent() ?>
</p>
<?php endif; ?>


<!-- ourfeling8 -->

<ins class="adsbygoogle"

     style="display:inline-block;width:300px;height:250px"

     data-ad-client="ca-pub-6382580135773552"

     data-ad-slot="8412723022"></ins>

<script>

(adsbygoogle = window.adsbygoogle || []).push({});

</script>

<?php foreach ($pager->getResults() as $i): ?>

<div class="hr"> </div>
<p> <?= $i->getBody()?></p>
<p><b><?= $i->getName()?> </b> </p>

<?php endforeach; ?>

<?php echo pager_navigation($pager, url_for('suggestions/index')) ?>

<div class="hr"> </div>
<h3> <?= __('Send your suggestion') ?></h3>

<form  enctype="multipart/form-data" method="post" class="form_style" action="<?= url_for('suggestions/index') ?>">

<?php echo $form ?>

    <div class="row" align="center">
       <input class="but" type="submit" value="<?= __('Submit') ?>" />
    </div>

</form>




<!-- ourfeling8 -->

<ins class="adsbygoogle"

     style="display:inline-block;width:300px;height:250px"

     data-ad-client="ca-pub-6382580135773552"

     data-ad-slot="8412723022"></ins>

<script>

(adsbygoogle = window.adsbygoogle || []).push({});

</script>
