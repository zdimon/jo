<div class="inner_page">

    <h1><?= __('Мои фото') ?></h1>

     <?php include_partial('form', array('form' => $form, 'step2'=>$step2)) ?>

		<?= __('Текст на странице фото') ?>	 
<br />		
    <?php if(count($photos)>0):?>
        <div class="photo_list">
            <?php foreach ($photos as $photo): ?>
            <div class="photo_item" style="float: left; width: <?= sfConfig::get('app_photo_width')?>px; padding: 5px;">
               <div class="lady_item_left">
               <?php echo link_to(image_tag('/uploads/photo/middle_thumbnail/'.$photo->getImage()),'http://'.$_SERVER['HTTP_HOST'].'/uploads/photo/original/'.$photo->getImage(),array('class'=>'floatleft')) ?>
               </div>
                <div align="center">
                    <?php if(!$photo->getIsMain()):?>
                      <?= link_to(__('Сделать главной'),'myphoto/setmain?id='.$photo->getId()); ?> <br />
                    <?php endif ?>
                     <?= link_to(__('Удалить'),'myphoto/del?id='.$photo->getId(),array('confirm'=>__('Вы уверены?'))); ?>
                </div>
                <div align="center">
                   <?= $photo->getStatusStr() ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
             <h2><?= __('нет фото') ?> </h2>
    <?php endif; ?>
    <div style="clear: both"> </div>

      <script type="text/javascript">
      $("a.floatleft").fancybox({
    'transitionIn' : 'none',
    'transitionOut' : 'none',
    'titlePosition' : 'inside',
    'titleFormat' : function(title, currentArray, currentIndex, currentOpts) {
    return '(' + (currentIndex + 1) + '/' + currentArray.length + ') ' + title;
    }
    });

    </script>


	
</div>
<?php if ($sf_user->getGuardUser()->getGender()=='w'): ?>
    <div align="center">
        <?= link_to(__('Add video'),'myvideo/index',array('class'=>'but')) ?>
    </div>
<?php endif; ?>
<?php if ($sf_user->isAuthenticated() and !$sf_user->getGuardUser()->getProfile()->getIsActive()): ?>
<div align="center">
    <?= link_to(__('Finish registration'),'registration/finish',array('class'=>'but')) ?>
</div>
  <?php endif; ?>
