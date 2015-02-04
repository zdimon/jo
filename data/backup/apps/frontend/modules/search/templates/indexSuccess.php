
<h1><?= $title ?></h1>

<div style="float: right">
    <?= link_to(__('Anniversary'),'search/anniversary') ?>
    <?= link_to(__('Only online'),'search/index?is_online=true') ?>
    <?= link_to(__('Most viewed'),'search/index?order=rating') ?>
    <?= link_to(__('Less viewed'),'search/index?order=unrating') ?>
    <?= link_to(__('New member'),'search/index?new=true') ?>
</div>




<br />

<?php if(!$pager->getNbResults()):?>
                   <div class="adm_mass att_block">
                    <a class="icons attention" href="#"></a>
                    <?php echo __('Ничего не найдено')  ?>
                    </div>
<?php else: ?>


<div class="lady_list">

    <?php foreach ($pager->getResults() as $u): ?>
      <?php include_partial('global/common/search_item',array('profile'=>$u,'arrc'=>$arrc)); ?>
    <?php endforeach; ?>
    

 </div>


<?php echo pager_navigation($pager, url_for('search/index')) ?>

<?php endif ?>
