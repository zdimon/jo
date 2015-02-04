<?php


class chatFilter extends sfFilter
{
  public function execute ($filterChain)
  {
  
     $filterChain->execute();
    /// онлайн
     

    if($this->getContext()->getUser()->isAuthenticated() and sfConfig::get('app_use_chat') and $this->getContext()->getRequest()->getParameter('module')!='chat' )
    {

       $response = $this->context->getResponse();
       $content = $response->getContent();

       $user = $this->getContext()->getUser()->getGuardUser();

       $room = Chat2RoomTable::getAlertRoom($user);

       if($room)
       {
            //$_SESSION['cur_chat_call']='true';
            $abonent = $room->getAbonent($user);

            $html =  get_component('chat', 'show_dialog',array('abonent'=>$abonent,'room'=>$room));

            if (false !== ($pos = strpos($content, '</body>')))
            {
               $response->setContent(substr($content, 0, $pos).$html.substr($content, $pos));
            }
    
    
       }
       
    }
    //

    
  }
}
