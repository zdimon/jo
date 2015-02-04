<h1> <?=  $page->getItitle() ?></h1>


<?= $page->getIcontent() ?>



<?php if($page->getAlias()!='terms'): ?>
<?php include_partial('global/common/forms/popup_register_form') ?>
<?php endif; ?>