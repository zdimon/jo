<?php $arrc = sfCultureInfo::getInstance(sfContext::getInstance()->getUser()->getCulture())->getCountries(); ?>

<div class="butonns_a"><a class="succ" href="<?= url_for('page/index?alias=story') ?>"></a> </div>
<?php if($mp): ?>
     <div class="pop_user">
                               <div class="p_ls_block_top">
                                    <div class="p_ls_block_bot">
                                        <div class="p_ls_block_bg">
                                            <img class="pop" src="/images/pop.png" alt="alt" />
                                            <div class="pop_content">
                                                <div class="pop_user_img">
                                                    <a href="<?= url_for('profile/show?username='.$mp->getsfGuardUser()->getUsername())?>"><img src="<?= $mp->getUrlImage() ?>" alt="<?= $mp->getRealName() ?>" /></a>
                                                    <span class="offline"></span><!--class="offline"-->
                                                     <?php include_partial('global/common/user_icons_tools',array('u'=>$mp->getsfGuardUser())); ?>
                                                </div>
                                                <div class="pop_data">
                                                    <span class="data_user">ID: <?= $mp->getUserId() ?></span>
                                                    <span class="pop_name"><a href="#"><?= $mp->getRealName() ?></a> Age: <span class="r"><?= $mp->getAge() ?></span></span>

                                                    <?= $arrc[$mp->getCountry()] ?>, <?= $mp->getCity() ?>
                                                </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
      </div>
<?php endif; ?>
