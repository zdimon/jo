
                                <form class="form_style f_quick_search textleft" action="<?php echo url_for('search/index')?>" method="get">
                              	<div class="row">
                                	<label><?= __('Возраст от') ?>:</label>
                               		<?= $form['age_from']->render()?>
                                </div>
                                <div class="row">
                                    <label class="to"><?= __('до') ?></label>
                                    <?= $form['age_to']->render()?>
                                </div>
                               
                                <div class="row"><label><?= __('Страна') ?>:</label><?= $form['country']->render()?></div>
                                <div class="row"><label>ID:</label><?= $form['user_id']->render()?></div>

                                    <div class="row pb10 textcenter">

                                        <input class="but" type="submit" value="<?= __('FIND')?>" style="width:100%" />
                                        <div class="textcenter size10"><a href="<?= url_for('search/adv') ?>"><?= __('Advanced Search')?></a></div>
                                    </div>
                           	 </form>