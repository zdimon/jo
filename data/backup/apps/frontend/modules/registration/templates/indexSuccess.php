
<?php $lform = new sfGuardFormSignin() ?>
<form method="post" action="<?php echo url_for('@sf_guard_signin') ?>">
    <?php echo $lform['_csrf_token']->render() ?>

    <div class="pb25 italic size18 bold"><?= __('Вход')?></div>
    <div class="pb25 italic bold"><label class="sUser_label"><?= __('Login') ?></label> <input  class="sUser_i"  type="text" name="signin[username]"  value="" /></div>
    <div class="pb25 italic bold"><label class="sUser_label"><?= __('Password') ?></label> <input  class="sUser_i"  type="password" name="signin[password]" value="" /></div>
    <div class="pb25 italic">
        <input type="submit" class="sUser_but" value="<?= __('Enter')?>">
    </div>
</form>


<div style='display:none'>
    <div id="inline_content">

        <?php if(!isset($success)):?>

        <h3><?= __('Registration') ?></h3>


        <form method="post" class="form_style validat" action="<?php echo url_for('registration/index?gender='.$form->getObject()->getGender()) ?>">
            <?php echo $form->renderHiddenFields() ?>
            <?php echo $form->renderGlobalErrors() ?>
            <?php echo $form['_csrf_token']->render() ?>




            <div class="row">
                <?php echo $form['username']->renderLabel(null, array('style'=>'width: 100px','class' => 'required star short')) ?>
                <?php echo $form['username'] ?>
                <?php echo $form['username']->renderError() ?>
            </div>

            <div class="row">
                <?php echo $form['password']->renderLabel(null, array('style'=>'width: 100px','class' => 'required star short')) ?>
                <?php echo $form['password'] ?>
                <?php echo $form['password']->renderError() ?>
            </div>





            <div class="row">
                <?php echo $form['country']->renderLabel(null, array('style'=>'width: 100px','class' => 'required star short')) ?>
                <?php echo $form['country'] ?>
                <?php echo $form['country']->renderError() ?>
            </div>

            <div class="row">
                <?php echo $form['email']->renderLabel(null, array('style'=>'width: 100px','class' => 'required star short')) ?>
                <?php echo $form['email'] ?>
                <?php echo $form['email']->renderError() ?>
            </div>

            <div class="row">
                <?php echo $form['birthday']->renderLabel(null, array('style'=>'width: 100px','class' => 'required star short')) ?>
                <?php echo $form['birthday'] ?>
                <?php echo $form['birthday']->renderError() ?>
            </div>


            <div class="row">
                <?php echo $form['gender']->renderLabel(null, array('style'=>'width: 100px','class' => 'required star short')) ?>
                <?php echo $form['gender'] ?>

            </div>

            <div class="row">
                <?php echo $form['culture']->renderLabel(null, array('style'=>'width: 100px','class' => 'required star short')) ?>
                <?php echo $form['culture'] ?>

            </div>

            <div class="row">
                <?php echo $form['captcha']->renderLabel(null, array('style'=>'width: 100px','class' => 'required star short')) ?>
                <?php echo $form['captcha'] ?>
                <?php echo $form['captcha']->renderError() ?>
            </div>



            <?php // if($form->getObject()->getGender()=='m'):?>
            <div class="row" style="padding-left: 40px">

                <?php echo $form['is_agree'] ?> <?= link_to(__('I have read and fully understood the our-feeling.com terms and conditions'),'@page?alias=terms',array('target'=>'_blank'))?>
                <?php echo $form['is_agree']->renderError() ?>
            </div>
            <?php // endif; ?>


            <div class="row input_but" align="center">
                <input class="but" type="submit" value="<?php echo __('Register') ?>" />
            </div>

        </form>

        <?php else: ?>
             <h3> <?= $success ?></h3>
        <?php endif; ?>

    </div>
</div>
</div>


<img src="/pic/logo_2.png" alt="" class="logo_2">
<img src="/pic/open_heart.png" alt="" class="open_heart">
<a href="#inline_content"  class="three_days" id="formregs"></a>
<div class="s_text">
    <div class="s_text_poss">
        <?= __('The text of the ad unit') ?>
    </div>
    <img src="/pic/iphone_decor.png" alt="" class="iphone_decor">
    <div class="s_copy"><span class="s_copy_text"><?= __('Copyright © 2012 Our-Feeling')?></span></div>
</div>

</div>
</div>

    <script type="text/javascript">

        $(".three_days").colorbox({open: true, inline:true, width:"50%"});

    </script>