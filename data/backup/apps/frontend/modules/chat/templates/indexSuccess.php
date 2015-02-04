<?php use_helper('Flash');  ?>
<script type="text/javascript" src="/js/swfobject.js"></script>


<div class="chat">
  <div id="chat_loading"> Loading...</div>



        <!-- Подключаем камеру девушки -->
        <?php //if($sf_user->getGuardUser()->getGender()=='w') include_component('chat','show_woman_video_in')?>
        <!--   /////////////////////    -->


        <div class="chat_content" id="chat_content">
        <?php if(isset($abonent)):?>        
            
              <script>
                <?php echo jq_remote_function( array(
                            'update' => 'chat_content',
                            'loading' => '$("#chat_loading").show();$("#chat_content").hide()',
                            'complete' => '$("#chat_loading").hide();$("#chat_content").show()',
                            'script'=>true,
                            'method'=>'GET',
                            'url' => 'chat/select_user?u='.$abonent->getUserId()
                        )
                        )
                ?>
                </script>         
                    
        <?php else: ?>
          <h1 style="color: red"> <?= __('Выберите абонента') ?></h1>
        <?php endif ?>
        </div>

         <!-- опросник пользователей в онлайне-->
                <?php
                        echo jq_periodically_call_remote(array(
					'frequency' => 120,
                                        'update' => 'user_list',
                                        'script'=>true,
                                        'method'=>'GET',
					'url' => url_for('chat/update_online_user'),
			))
                ?>


         <!-- получение сообщений -->
                <?php

                        echo jq_periodically_call_remote(array(
					'frequency' => 10,
                                        'update' => 'chat_message_box',
                                        'loading' => '$("#chat_loading").show()',
                                        'complete' => '$("#chat_loading").hide()',
                                        'script'=>true,
                                        'method'=>'GET',
					'url' => url_for('chat/gm'),
			))
                ?>

                  <!-- платежи -->
               <?php if($sf_user->getGuardUser()->getGender()=='m'):?>
                <?php
                        echo jq_periodically_call_remote(array(
					'frequency' => 60,
                                        'update' => 'chat_account',
                                        'script'=>true,
                                        'method'=>'GET',
					'url' => url_for('chat/pay'),
			))
                ?>
                <?php endif ?>




            <!-- Обновляем контакты-->
               
                <?php echo jq_periodically_call_remote( array(
                            'update' => 'chat_contact_list',
                            'frequency' => 60,
                            'loading' => '$("#chat_loading").show();',
                            'complete' => '$("#chat_loading").hide();',
                            'script'=>true,
                            'method'=>'GET',
                            'url' => 'chat/show_contact'
                        )
                        )
                ?>
               



                      
</div>






