<h1> <?=  $page->getItitle() ?></h1>


<?= $page->getIcontent() ?>

<?php if(isset($form)): ?>

<form class="form_style"  action="<?php echo url_for('page/index?alias='.$page->getAlias()) ?>" method="POST">

	<?php echo $form ?>

    <div class="row input_but" align="center">
		<input class="but" type="submit" value="<?php echo __('Отправить') ?>" />
   </div>

</form>

<?php endif; ?>