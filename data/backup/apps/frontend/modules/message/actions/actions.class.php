<?php

/**
 * message actions.
 *
 * @package    piramida
 * @subpackage message
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class messageActions extends commonActions
{

    public function executeCheck(sfWebRequest $request)
    {
        $this->checkAuthorization();

        //// Сообщения
         $this->mes = Doctrine::getTable('Message')
            ->createQuery('a')
            ->where('a.to_id=? and popup=?', array($this->getUser()->getGuardUser()->getId(),false))
            ->fetchOne();
        if($this->mes)
        {
            $this->mes->setPopup(true);
            $this->mes->save();
        }

        //// Добавление в фавориты
        $this->fav = Doctrine::getTable('Friend')
            ->createQuery('a')
            ->where('a.friend_id=? and a.popup_add=?', array($this->getUser()->getGuardUser()->getId(),false))
            ->fetchOne();
        if($this->fav)
        {
            $this->fav->setPopupAdd(true);
            $this->fav->save();
        }

        //// Посылка интереса
        $this->int = Doctrine::getTable('Interest')
            ->createQuery('a')
            ->where('a.interest_id=? and a.popup=?', array($this->getUser()->getGuardUser()->getId(),false))
            ->fetchOne();
        if($this->int)
        {
            $this->int->setPopup(true);
            $this->int->save();
        }

        //// Визит
        $this->viw = Doctrine::getTable('Viewed')
            ->createQuery('a')
            ->where('a.interest_id=? and a.popup=?', array($this->getUser()->getGuardUser()->getId(),false))
            ->fetchOne();
        if($this->viw)
        {
            $this->viw->setPopup(true);
            $this->viw->save();
        }


        //// матч
        $this->mat = Doctrine::getTable('Friend')
            ->createQuery('a')
            ->where('a.friend_id=? and a.popup_match=?', array($this->getUser()->getGuardUser()->getId(),false))
            ->fetchOne();
        if($this->mat)
        {
            $this->mat->setPopupMatch(true);
            $this->mat->save();
        }


        $this->setLayout(false);
    }

    public function executeSavedraft(sfWebRequest $request)
    {
        $this->checkAuthorization();
        $m = Doctrine::getTable('Message')
            ->createQuery('a')
            ->where('a.from_id=? and a.to_id=? and type_message=?',array($this->getUser()->getGuardUser()->getId(),$request->getParameter('id'),'draft'))
            ->fetchOne();
        if(!$m)
        {
            $m = new Message();
            $m->setContent($request->getParameter('vars'));
            $m->setFromId($this->getUser()->getGuardUser()->getId());
            $m->setToId($request->getParameter('id'));
            $m->setPub(false);
            $m->setTypeMessage('draft');
        }
        else{
            $m->setContent($request->getParameter('vars'));
        }

        $m->save();
    }



    public function executeDraft(sfWebRequest $request)
    {
        $this->checkAuthorization();
        $this->insertArrays();
        $q = Doctrine::getTable('Message')
            ->createQuery('a')
            ->where('a.from_id=? and type_message=?',array($this->getUser()->getGuardUser()->getId(),'draft'))
            ->orderBy('a.id DESC');

        $this->pager = new sfDoctrinePager('Message',20);
        $this->pager->setQuery($q);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }


      public function executeRead(sfWebRequest $request)
  {
      $this->checkAuthorization();
      $m = Doctrine::getTable('Message')->find($request->getParameter('id'));
      $this->forward404Unless($m);
      if($m->getFromId()!=$this->getUser()->getGuardUser()->getId() and $m->getToId()!=$this->getUser()->getGuardUser()->getId()) $this->redirect ('access/denite');

      $user_to = $m->getFromUser();
      $user_from = $this->getUser()->getGuardUser();
      /// Проверка на черный список
      if(!$this->checkBlacklist($user_to)) $this->redirect ($this->getRef ());

      ///Проверка на деньги мужиков
     // if($this->getUser()->getGuardUser()->getGender()=='m' and $m->getFromId()!=$this->getUser()->getGuardUser()->getId())
     // {
     //   if(!$this->checkAccount($user_from, 1)) $this->redirect ($this->getRef ());
     // }
      ///делаем платеж
     // if($this->getUser()->getGuardUser()->getGender()=='m' and $m->getFromId()!=$this->getUser()->getGuardUser()->getId() and $m->getTypeMessage()!='first')
    //    {
     //     $this->makePayment($this->getUser()->getGuardUser(), 1, $user_to);
        
      //  }
       ///отмечаем как прочтенное
           $m->setIsRead(true);
           $m->save();

      ///Редирект на абонента если письмо от себя
      if( $m->getFromId()==$this->getUser()->getGuardUser()->getId())
      {
              $this->redirect('message/personal_show?u='.$m->getToId());
      }

      $this->redirect('message/personal_show?u='.$m->getFromId());
  }

      public function executePersonal_show(sfWebRequest $request)
  {
      ////Определяем кого открываем
      $this->setHotlist($request);

      if(isset($_SESSION['hot_id']))
      {
         
          ///Выбераем сообщения
        $this->message = Doctrine::getTable('Message')
          ->createQuery('a')
          ->where('((a.to_id=? and a.from_id=?) or (a.to_id=? and a.from_id=?)) and a.del_from=? and a.type_message<>? and a.type_message<>?',array($this->getUser()->getGuardUser()->getId(),$_SESSION['hot_id'],$_SESSION['hot_id'],$this->getUser()->getGuardUser()->getId(),false,'draft','first'))
          ->orderBy('a.id DESC')
          ->execute();

        ///отмечаем как прочитанные
         $this->setIsRead($request);
       
        ///Выбираем абонента
        $this->ab = ProfileTable::getProfileById($_SESSION['hot_id']);

          $this->insertArrays();
      }
  }


  public function executePersonal(sfWebRequest $request)
  {
      $this->checkAuthorization();
      $this->insertArrays();
    $this->autoLogin($request);
    if(!$this->getUser()->isAuthenticated()) $this->redirect ('access/onlyregister');
    /// Выбирает хотлист
      $this->hot = Doctrine::getTable('Hotlist')
      ->createQuery('a')
      ->where('a.from_id=?',array($this->getUser()->getGuardUser()->getId()))
      ->orderBy('a.updated_at DESC')
      ->execute();
    ///
      
    
  }


  public function executeIndex(sfWebRequest $request)
  {
      $this->autoenter();
      $this->checkAuthorization();
      $this->insertArrays();



    $q = Doctrine::getTable('Message')
      ->createQuery('a')
      ->where('a.to_id=? and a.del_to=?',array($this->getUser()->getGuardUser()->getId(),false))
      ->orderBy('a.id DESC');

      $q = $this->setFilter($q,$request,'in');

       $this->pager = new sfDoctrinePager('Message',20);
       $this->pager->setQuery($q);
       $this->pager->setPage($request->getParameter('page', 1));
       $this->pager->init();

    $pf = ProfileTable::getProfileById($this->getUser()->getGuardUser()->getId());
    $pf->setIsNewMessage(false);
    $pf->save();
  }

    public function executeOut(sfWebRequest $request)
  {
      $this->checkAuthorization();
      $this->insertArrays();
    $q = Doctrine::getTable('Message')
      ->createQuery('a')
      ->where('a.from_id=? and a.pub=?',array($this->getUser()->getGuardUser()->getId(),true))
      ->orderBy('a.id DESC');

      $q = $this->setFilter($q,$request,'out');

      $this->pager = new sfDoctrinePager('Message',20);
       $this->pager->setQuery($q);
       $this->pager->setPage($request->getParameter('page', 1));
       $this->pager->init();

  }

    public function executeDeleted(sfWebRequest $request)
  {
      $this->checkAuthorization();
    $q = Doctrine::getTable('Message')
      ->createQuery('a')
      ->where('a.to_id=? and a.del_to=?',array($this->getUser()->getGuardUser()->getId(),true))
      ->orderBy('a.id DESC');

       $this->pager = new sfDoctrinePager('Message',20);
       $this->pager->setQuery($q);
       $this->pager->setPage($request->getParameter('page', 1));
       $this->pager->init();

  }


 public function executeDelfrom(sfWebRequest $request)
  {
      $this->checkAuthorization();
     $mes = Doctrine::getTable('Message')->find($request->getParameter('id'));
     if($mes)
     {
         $mes->setDelFrom(true);
         $mes->save();
     }

      $this->redirect('message/index');
  }

 public function executeDelto(sfWebRequest $request)
  {
      $this->checkAuthorization();
     $mes = Doctrine::getTable('Message')->find($request->getParameter('id'));
     if($mes)
     {
         $mes->setDelTo(true);
         $mes->save();
     }
      if ($request->isMethod ( 'post' ))
      {
          $it = $request->getParameter('sel');
          foreach($it as $k=>$v)
          {
              $mes = Doctrine::getTable('Message')->find($v);
              $mes->setDelTo(true);
              $mes->save();
          }
      }
      $this->redirect('message/index');
  }
 

  public function executeSend(sfWebRequest $request)
  {
      $this->checkAuthorization();
     /////Проверяем статус
       if(!$this->checkStatus()) $this->redirect ($this->getRef ());
     /////

      /////Проверяем пакет
     // $this->checkPacket();
      /////

      $user_from = $this->getUser()->getGuardUser();
      $profile = $user_from->getProfile();
      $error = $profile->checkPacketForMessage();
      if(strlen($error)>0)
      {
          $this->getUser ()->setFlash ( 'error', $error );
          $this->redirect ($this->getRef ());
      }


    $this->insertArrays();
     if(!$this->getUser()->isAuthenticated()) $this->redirect('access/onlyregister');
     $i = Doctrine::getTable('sfGuardUser')
     ->createQuery('a')
     ->where('a.username=?',array($request->getParameter('username')))
     ->fetchOne();

    $this->forward404Unless($i);




    $user_to   = $i;
    
    $this->user_to   = $i;

    /// Проверка на черный список
    if(!$this->checkBlacklist($user_to)) $this->redirect ($this->getRef ());

    /// Проверка на однополые
    if(!$this->checkSameGender($user_from, $user_to)) $this->redirect ($this->getRef ());

    ///Проверка на деньги мужиков
    //if($this->getUser()->getGuardUser()->getGender()=='m')
   // {
    //  if(!$this->checkAccount($user_from, 2)) $this->redirect ($this->getRef ());
    //}

    $m = new Message();
    $m->setToId($i->getId());
    if($request->getParameter('reply_id')>0)
    {
            
            $this->reply = Doctrine::getTable('Message')->find($request->getParameter('reply_id'));
            if( $this->reply)
            {
			if(!$this->reply->getIsRead() and $this->getUser()->getGuardUser()->getGender()=='m' and $this->reply->getFromId()!=$this->getUser()->getGuardUser()->getId())
			{
			  $this->getUser ()->setFlash ( 'message', __('Вы не можете ответить на не просмотренное письмо!') );
			  $this->redirect($this->getRef());
			}
			$m->setReplyId ($request->getParameter('reply_id'));
            }
    }
    $m->setFromId($this->getUser()->getGuardUser()->getId());
    $this->form = new frontendMessageForm($m);
  }

  public function executeSave(sfWebRequest $request)
  {
      $this->checkAuthorization();
      $this->form = new frontendMessageForm( );

		if ($request->isMethod ( 'post' ))
		{
			$this->form->bind ( $request->getParameter ( 'message' ), $request->getFiles('message') );
                        if ($this->form->isValid ()) {
                            $m = $this->form->save();

                            $this->getUser ()->setFlash ( 'message', __('Ваше сообщение отправлено') );
                            if($this->getUser()->getGuardUser()->getGender()=='m')
                              {
                                // $this->makePayment($this->getUser()->getGuardUser(), 2, $m->getToUser());
                              }
                            $this->delDraft($m->getToId());
                            //$this->sendMail($m->getToUser(), $this->getUser()->getGuardUser());
                            NotifyTable::sendTemplate($m->getToUser(),$this->getUser()->getGuardUser(),3);
                            if(sfConfig::get('app_personal_mail')==true)  $this->redirect('message/personal_show?u='.$m->getToId());

                            $this->redirect('message/index');
                        }
        }


      $this->getUser ()->setFlash ( 'error', __('Ошибка отправки сообщения') );
      $this->setTemplate('send');
     //$this->redirect('message/index');
  }

   public function executeShow(sfWebRequest $request)
  {
      $this->checkAuthorization();
      $this->insertArrays();
       $this->m = Doctrine::getTable('Message')->find($request->getParameter('id'));
       $profile = $this->getUser()->getGuardUser()->getProfile();
       if($this->m->getFromId()!=$this->getUser()->getGuardUser()->getId() and $this->m->getToId()!=$this->getUser()->getGuardUser()->getId() ) $this->redirect ('access/denite') ;
       if($this->m->getFromId()!=$this->getUser()->getGuardUser()->getId() and $this->getUser()->getGuardUser()->getGender()=='m' and !$this->m->getIsRead())
       {
           // Оплата просмотра
           //$user = $this->m->getToUser();
           $error = $profile->checkPacketForMessage();
          if(strlen($error)>0)
          {
              $this->getUser ()->setFlash ( 'error', $error );
              $this->redirect ($this->getRef ());
          }


          // $this->makePayment($this->getUser()->getGuardUser(), 1, $user);

       }
       /// Ставим что прочитано
        if($this->m->getFromId()!=$this->getUser()->getGuardUser()->getId())
        {
            $this->m->setIsRead(true);
            $this->m->save();
        }

  }


    public function executeAshow(sfWebRequest $request)
    {
        $this->checkAuthorization();
        $this->insertArrays();
        $this->m = Doctrine::getTable('Message')->find($request->getParameter('id'));
        $profile = $this->getUser()->getGuardUser()->getProfile();
        if($this->m->getFromId()!=$this->getUser()->getGuardUser()->getId() and $this->m->getToId()!=$this->getUser()->getGuardUser()->getId() ) $this->redirect ('access/denite') ;

        if($this->m->getFromId()!=$this->getUser()->getGuardUser()->getId()  and !$this->m->getIsRead())
        {

            // Оплата просмотра
            //$user = $this->m->getToUser();
            $error = $profile->checkPacketForMessage();
            if(strlen($error)>0)
            {
                $this->message = $error;
                   return sfView::SUCCESS;
            }


            // $this->makePayment($this->getUser()->getGuardUser(), 1, $user);

        }
        /// Ставим что прочитано
        if($this->m->getFromId()!=$this->getUser()->getGuardUser()->getId())
        {
            $this->m->setIsRead(true);
            $this->m->save();
        }

        $this->message = $this->m->getContent();
        $this->setLayout(false);
    }


  ///Функция определения кого открыть

  protected function setHotlist(sfWebRequest $request)
  {
    if($request->getParameter('h')>0)
      {
          $h = Doctrine::getTable('Hotlist')->find($request->getParameter('h'));
          $this->forward404Unless($h);
          $_SESSION['hot_id'] = $h->getToId();
      }
      elseif($request->getParameter('m'))
      {
          $m = Doctrine::getTable('Message')->find($request->getParameter('m'));
          $this->forward404Unless($m);
          $_SESSION['hot_id'] = $m->getToId();
      }
      elseif($request->getParameter('u'))
      {
          $_SESSION['hot_id'] = $request->getParameter('u');
      }
  }

    protected function setIsRead(sfWebRequest $request)
  {
        ///Отмечаем как прочитанные для женщин
        if($this->getUser()->getGuardUser()->getGender()=='w')
        {
          Doctrine_Query::create()
            ->update('Message a')
            ->set('is_read', 'true')
            ->where('a.from_id=? and a.to_id=?',array($_SESSION['hot_id'],$this->getUser()->getGuardUser()->getId()))
            ->execute();
        }

          $cnt = Doctrine::getTable('Message')
          ->createQuery('a')
          ->where('a.to_id=? and a.is_read=?',array($this->getUser()->getGuardUser()->getId(),false))
          ->count();
          
          if($cnt==0)
          {
              
            $pf = ProfileTable::getProfileById($this->getUser()->getGuardUser()->getId());
            $pf->setIsNewMessage(false);
            $pf->save();
          }


  }


    protected function sendMail($user_to, $user_from)
  {
         if(sfConfig::get('app_personal_mail'))
         {
         $par = array(
              '%name%' => $user_to->getProfile()->getFirstName().' '.$user_to->getProfile()->getLastName(),
              '%user%' => $user_to->getProfile()->getFirstName().' '.$user_to->getProfile()->getLastName(),
              '%link%' => link_to(__('link'),'message/personal?code='.$user_to->getSalt(),array('absolute' => true)),
              '%link_char%' => url_for('message/personal?code='.$user_to->getSalt(),array('absolute' => true))
          );
         }
         else
         {
         $par = array(
              '%name%' => $user_to->getProfile()->getFirstName().' '.$user_to->getProfile()->getLastName(),
              '%user%' =>$user_to->getProfile()->getFirstName().' '.$user_to->getProfile()->getLastName(),
              '%link%' => link_to(__('link'),'message/index?code='.$user_to->getSalt(),array('absolute' => true)),
              '%link_char%' => url_for('message/personal?code='.$user_to->getSalt(),array('absolute' => true))
          );
         }
          NotifyTable::sendNotify($user_to, 3, $par);

  }

    protected function delDraft($to_id)
    {
            Doctrine_Query::create()
            ->delete()
            ->from('Message')
            ->addWhere('from_id = ? and to_id=? and type_message=?',array($this->getUser()->getGuardUser()->getId(),$to_id,'draft'))
            ->execute();

    }


    protected function checkPacket()
    {
        $p = $this->getUser()->getGuardUser()->getProfile();
        if($p->getPacketId()==1 and $p->getGender()=='m')
        {
            $this->getUser ()->setFlash ( 'error', __('Your membership doesn`t allow this action!') );
            $this->redirect ($this->getRef ());
        }
    }

    protected function setFilter($q,$request,$type)
    {

        if(!isset($_SESSION['filter'])) $_SESSION['filter'] = 'all';

        if($request->getParameter('f')=='all')
        {
          $_SESSION['filter'] = 'all';
        }
        elseif($request->getParameter('f')=='read')
        {
          $_SESSION['filter'] = 'read';

                $q->addWhere('a.is_read=?',array(true));

        }
        elseif($request->getParameter('f')=='unread')
        {
          $_SESSION['filter'] = 'unread';
            $q->addWhere('a.is_read=?',array(false));
        }

        return $q;
    }

}
