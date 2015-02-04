<h1><?php echo __('Новое сообщение') ?></h1>



<?php include_partial('message/menu')?>

<div id="status_div" >

</div>
<div align="center">
    <div style=" padding: 10px; width: 550px; border: 1px solid #FFB552">
        <table class="" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>

                <td width="200px">
                    <?= include_partial('global/common/user_info',array('profile'=>$user_to->getProfile(),'arrc'=>$arrc,'arrl'=>$arrl)) ?>

                 </td>
                  <?php if(isset($reply)):?>
                 <td valign="top" style="padding-left: 10px">
                    <b> <?= __('Ответ на сообщение') ?>:</b>
                     <div style="margin: 4px; background: #ffffff; width: 300px; height: 220px; overflow: auto;">
                     <?= myTools::stripMessage($reply->getContent()) ?>
                     </div>
                 </td>
                 <?php endif; ?>

            </tr>
        </table>






        <form id="" action="<?php echo url_for('message/save') ?>" method="post" class="" enctype="multipart/form-data">

              <?php echo $form ?>

                     <div class="row input_but" align="center">
                          <input class="but" type="submit" value="<?php echo __('Отправить сообщение') ?>" />
                     </div>

        </form>

        </div>
    </div>


<?php // echo jq_periodically_call_remote(array(
    //  'frequency' => 30,
     // 'update' => 'status_div',
    //  'script'=>true,
    //  'method'=>'POST',
    //  'with'    => "'vars=' +$('#message_content').val()",
    //  'url' => 'message/savedraft?id='.$user_to->getId()
//)) ?>
