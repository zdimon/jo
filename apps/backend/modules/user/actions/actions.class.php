<?php

require_once dirname(__FILE__).'/../lib/userGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/userGeneratorHelper.class.php';

/**
 * user actions.
 *
 * @package    levandos
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends autoUserActions
{



    public function executeGetphotoonapprove(sfWebRequest $request)
    {
       if($request->getParameter('i'))
       {
           $p = PhotoTable::getInstance()->find($request->getParameter('i'));
           if($request->getParameter('act')=='on')
           {
              $p->setPub(true);
              $p->save();
           }

           if($request->getParameter('act')=='del')
           {
               $p->delete();
           }

       }


       $this->photos = PhotoTable::getInstance()
           ->createQuery('a')
           ->where('a.pub=?',array(false))
           ->execute();

    }
    
    
    public function executeSetmembership(sfWebRequest $request)
  {
        $p = ProfileTable::getInstance()->find($request->getParameter('u'));
        $p->setPacketId($request->getParameter('i'));
        $p->save();
        $user = $p->getsfGuardUser();
        
        if($user->getDateExpire()<date('Y-m-d'))
        {
            $dt = new sfDate();
        } else {
            $dt = new sfDate($user->getDateExpire());
        }
        
        $dt->addMonth($request->getParameter('m'));
        if($request->getParameter('i')>1)
        {
        $user->setDateExpire($dt->dump());
        } else {
            $dt = new sfDate();
            $dt->subtractDay(1);
             $user->setDateExpire($dt->dump());
        }
        $user->save();
        $this->profile = $p;
        
        
  }
    
   public function executeGallery(sfWebRequest $request)
  {
        $q = Doctrine::getTable('Profile')
       ->createQuery('a')
       ->leftJoin('a.sfGuardUser s')
       ->where('is_staff=? and is_false=?',array(false,false))
       ->orderBy('a.id DESC');
        $q = $this->setCriteria($q,$request);
        $this->pager = new sfDoctrinePager('Profile',45);
        $this->pager->setQuery($q);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        
  }
  
  private function setCriteria($q,$request)
  {
      if($request->getParameter('gender'))
      {
          $this->gender = $request->getParameter('gender');
          $q->addWhere('s.gender=?',array($request->getParameter('gender')));
      }
      
            if($request->getParameter('user_id'))
      {
          $this->user_id = $request->getParameter('user_id');
           $id = substr($request->getParameter('user_id'), 1, strlen($request->getParameter('user_id')));
          $q->addWhere('s.id=?',array($id));
      }
      
           if($request->getParameter('login'))
      {
          $this->login = $request->getParameter('login');
          $q->addWhere('s.username=?',array($request->getParameter('login')));
      }
      
         if($request->getParameter('email'))
      {
          $this->email = $request->getParameter('email');
          $q->addWhere('s.email=?',array($request->getParameter('email')));
      }
      
      
      
      return $q;
  }

    public function executeFix(sfWebRequest $request)
  {
      $pr = ProfileTable::getInstance()->findAll();
      foreach ($pr as $p)
      {
          $p->updateWithPhoto();

      }
    echo 'done';
    die;
          
  }
  

  public function preExecute()
  {
     parent:: preExecute();
     unset($_SESSION['access_payment']);

  }
  public function executeAjaxapprove(sfWebRequest $request)
  {
    $p = ProfileTable::getInstance()->find($request->getParameter('i'));
    $p->setStatusId(1);
    $p->setIsActive(true);
    $p->save();

    $user = $p->getsfGuardUser();
    $user->getIsActive(true);
    $user->save();    
    $this->sendNotify($user);
    
    $this->pr = ProfileTable::getInstance()->createQuery('a')->where('a.status_id=?',array($request->getParameter('type')))->execute();
    $this->type = $request->getParameter('type');
    $this->setTemplate('getonapprove');
    $this->setLayout(false);
  }
  
  public function executeGetonapprove(sfWebRequest $request)
  {
    $this->pr = ProfileTable::getInstance()->createQuery('a')->where('a.status_id=?',array($request->getParameter('type')))->execute();
    $this->type = $request->getParameter('type');
    $this->setLayout(false);
  }
  
  
     public function executeIsnew(sfWebRequest $request)
  {
    $p = ProfileTable::getInstance()->find($request->getParameter('i'));
    
    if($p->getIsNew())
    {
        $p->setIsNew(false);
    }
    else
    {
      $p->setIsNew(true);
    }
    $p->save();
    $this->profile = $p;
  }
  
       public function executeIsfalse(sfWebRequest $request)
  {
    $p = sfGuardUserTable::getInstance()->find($request->getParameter('i'));
    
    if($p->getIsFalse())
    {
        $p->setIsFalse(false);
        $p->setOwnerId(0);
        $p->setIsOnline(false);
    }
    else
    {
        $p->setIsFalse(true);
        $p->setOwnerId($this->getUser()->getGuardUser()->getId());
        $p->setIsOnline(true);
    }
    $p->save();
    $this->profile = $p->getProfile();
  }
  
  public function executeChangefalse(sfWebRequest $request)
  {
	$command = $request->getParameter('i');
	if($command == "start"){
		$fp = fopen(".runFalse","w");
		fclose($fp);
	}else{
		unlink(".runFalse");
	}
  }
  
   public function executeGender(sfWebRequest $request)
  {
    $p = ProfileTable::getInstance()->find($request->getParameter('i'));
    $u = $p->getsfGuardUser();
    if($p->getGender()=='m')
    {
        $p->setGender('w');
        $u->setGender('w');
    }
    else
    {
        $p->setGender('m');
        $u->setGender('m');
    }
    $p->save();
    $u->save();
    $this->p = $p;
  }
  
  public function executeSetmain(sfWebRequest $request)
  {

   $p = Doctrine::getTable('Photo')->find($request->getParameter('id'));
   $this->forward404Unless($p);
  
   $pr = $p->getUser()->getProfile();

    if(($p->getPartnerId()==$this->getUser()->getGuardUser()->getId()) or $this->getUser()->hasCredential('admin'))
   {
        Doctrine_Query::create()
        ->update('Photo p')
        ->set('is_main',0)
        ->where('p.user_id=?', array($pr->getUserId()))
        ->execute();
        $p->setIsMain(true);
        $p->save();
        $pr->setPhoto($p->getImage());
        $pr->save();
        $this->getUser ()->setFlash ( 'message', __('Указанное фото установлено в качестве главного.') );
   }
    $this->redirect($request->getReferer());

  }


    protected function addSortQuery($query)
  {
//    if (array(null, null) == ($sort = $this->getSort()))
//    {
//      return;
//    }
//
//    $query->addOrderBy($sort[0] . ' ' . $sort[1]);
    $query->addOrderBy('status_id DESC');
    $query->addOrderBy('created_at DESC');
  }

    public function executeInblack(sfWebRequest $request)
    {
        $p = Doctrine::getTable('Profile')->find($request->getParameter('id'));
        if($p->getScamer())
        {
            $p->setScamer(false);
        }
        else{

            $p->setScamer(true);
        }
        $p->save();
        $this->redirect('@profile');
    }

     public function executeActivate(sfWebRequest $request)
  {
     
    $p = Doctrine::getTable('Profile')->find($request->getParameter('id'));
     
    if($p)
    {

      $p->setStatusId(1);

      $p->setIsActive(true);

      $user = $p->getsfGuardUser();
      $user->getIsActive(true);

      $user->save();   
      $p->save();
      $this->sendNotify($user);     
      //die('st-'.$p->getStatusId());  
      //
      //die('st-'.$p->getStatusId());
    }

    $this->redirect('@profile');
  }

   protected function executeBatchDelete(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');



    foreach ($ids as $k=>$v)
    {
        $p = Doctrine::getTable('Profile')->find($v);
        myUser::deleteUser($p->getUserId());
      
    }


    $this->redirect('@profile');
  }


    public function executeBatchOndelete(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $q = Doctrine_Query::create()
      ->from('Profile p')
      ->whereIn('p.id', $ids);

    foreach ($q->execute() as $p)
    {
      $p->setStatusId(5);
      $p->setIsActive(false);
      $p->save();
    }
    $this->getUser()->setFlash('notice', 'The selected jobs have been activate successfully.');
    $this->redirect('user/index');
  }


    public function executeBatchActivate(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $q = Doctrine_Query::create()
      ->from('Profile p')
      ->whereIn('p.id', $ids);

    foreach ($q->execute() as $p)
    {
      $p->setStatusId(1);
      $p->setIsActive(true);
      $user = $p->getsfGuardUser();
      $user->getIsActive(true);
      $user->save();    
      $this->sendNotify($user);      
      $p->save();
    }
    $this->getUser()->setFlash('notice', 'The selected jobs have been activate successfully.');
    $this->redirect('user/index');
  }

  public function executeBatchDeactivate(sfWebRequest $request)
  {

    $ids = $request->getParameter('ids');

    foreach ($ids as $i)
    {
      $p = Doctrine::getTable('Profile')->find($i);
      $p->setStatusId(4);
      $p->setIsActive(false);
      $p->save();
    }

    $this->getUser()->setFlash('notice', 'The selected jobs have been activate successfully.');
    $this->redirect('user/index');
  }


     public function executeFilterMan(sfWebRequest $request)
  {

    $this->getUser()->setAttribute(
	'user.filters',
	array('gender'=>'m'),
	'admin_module'
	);
	$this->redirect('user/index');
  }
  
       public function executeFilterUserid(sfWebRequest $request)
  {
    $this->setFilters($this->configuration->getFilterDefaults());
    $this->getUser()->setAttribute(
	'user.filters',
	array('user_id'=>$request->getParameter('user_id')),
	'admin_module'
	);
	$this->redirect('user/index');
  }

     public function executeFilterWoman(sfWebRequest $request)
  {

    $this->getUser()->setAttribute(
	'user.filters',
	array('gender'=>'w'),
	'admin_module'
	);
	$this->redirect('user/index');
  }

  
   public function executeFilterPhoto(sfWebRequest $request)
  {
    $u = Doctrine::getTable('sfGuardUser')->find($request->getParameter('id'));
    $pf = $u->getProfile();
    $this->getUser()->setAttribute(
	'photo.filters',
	array('user_id'=>$pf->getUserId()),
	'admin_module'
	);
	$this->redirect($this->generateUrl('photo'));
  }


     public function executeFilterVideo(sfWebRequest $request)
  {

     $u = Doctrine::getTable('sfGuardUser')->find($request->getParameter('id'));
    $pf = $u->getProfile();
    $this->getUser()->setAttribute(
	'video.filters',
	array('user_id'=>$pf->getUserId()),
	'admin_module'
	);
	$this->redirect($this->generateUrl('video'));
  }

       public function executeFilterMessage(sfWebRequest $request)
  {
    $pf = Doctrine::getTable('Profile')->find($request->getParameter('id'));
    $this->getUser()->setAttribute(
	'message.filters',
	array('user_id'=>$pf->getUserId()),
	'admin_module'
	);
	$this->redirect($this->generateUrl('message'));
  }

         public function executeFilterPartner(sfWebRequest $request)
  {
    
    $this->getUser()->setAttribute(
	'user.filters',
	array('partner_id'=>array('text'=>$request->getParameter('id'))),
	'admin_module'
	);
	$this->redirect('user/index');
  }



    public function executeEdit(sfWebRequest $request)
  {


      $p = ProfileTable::getProfileById($request->getParameter('id'));
      $this->forward404Unless($p);

    /// Проверяем доступ
      if($p->getUserId()!=$this->getUser()->getGuardUser()->getId() and !$this->getUser()->hasCredential('admin') and $p->getsfGuardUser()->getPartnerId()!=$this->getUser()->getGuardUser()->getId())
      $this->redirect('access/denite');
  ///

      $this->profile = $p;
      $this->form = new admUserForm($p);

      if ($request->isMethod ( 'post' ))
		{
          
			$this->form->bind ( $request->getParameter ( 'profile' ));
			if ($this->form->isValid ()) {
                          
                          $pf = $this->form->save();
			                    $this->saveKeywords($request, $pf);			  
                      
                          $this->redirect ( 'user/show?id=',$pf->getUserId() );

			}


		}


  }
  
     private function saveKeywords($request,$user)
        {
        
         User2KeywordTable::getInstance()->createQuery('a')
                 ->delete()
                 ->where('a.user_id=?',array($user->getId()))
                 ->execute();
            $arr = $request->getParameter('keywords');
          
            foreach ($arr as $k=>$v)
            {
                $u2k = new User2Keyword();
                $u2k->setUserId($user->getId());
                $u2k->setKeywordId($v);
                $u2k->save();
           
            }
       
        }
  
        

  protected function buildQuery()
  {
    $query = parent::buildQuery();
   // if(!$this->getUser()->hasCredential('admin'))
   // {
   //     $query->andWhere(
    //            'partner_id = ?', $this->getUser()->getGuardUser()->getId()
     //           );
   // }
        
    //print_r($this->filters->get);
    //die;
    
    //print_r($_SESSION['symfony/user/sfUser/attributes']['admin_module']['user.filters']['user_id']);
    
    
    
    $query->andWhere('status_id<>6 and is_staff=false');
    return $query;
  }

   protected function ForprocessForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? __('Анкета зоздана') : __('Изменения сохранены');

      $pars =  $request->getParameter('profile');
      if($form->getObject()->isNew())
      {
          
          $pas = rand(999,99999);
          $sg = new sfGuardUser();
          $sg->setEmail($pars['email']);
          $sg->setPartnerId($this->getUser()->getGuardUser()->getId());
          $sg->setPassword($pas);
          $sg->setRealName($pas);
          $sg->setCulture('ru');
          $sg->setIsActive(true);
          $sg->save();
          $sg->setUsername($pars['real_name'].$sg->getId());
          $sg->save();
      }
      else {
          $sg = $form->getObject()->getsfGuardUser();
          $sg->setEmail($pars['email']);
          $sg->save();
      }


      $profile = $form->save();


       ////Сохраняем мультики

            $arr = array();
            $arr = $pars;
            $str = myTools::db_array_field($pars['relationship']);
            $profile->setRelationship($str);
          

      $profile->setUserId($sg->getId());
      if($profile->getStatusId()!=1)
      {
         $profile->setStatusId(2);
      }
	  
	  if(!$this->getUser()->hasCredential('admin'))
	  {
		$profile->setStatusId(2);
	  }
      

      ///Перевод в агенство
       if($pars['partner_id']>0)
       {
         
           $sg->setPartnerId($pars['partner_id']);
           $profile->setPartnerId($pars['partner_id']);
           $sg->save();

       }
       else
       {
            $profile->setPartnerId($this->getUser()->getGuardUser()->getId());
       }

      ///
     
      $profile->save();

      $sg->setRealName($profile->getRealName());
      $sg->save();
      $this->saveKeywords($request, $sg);

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $profile)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@profile_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('profile/addphoto?id='.$sg->getId());
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

    ///////Фильтры////////////////////////

     public function executeFilterReset(sfWebRequest $request)
  {
     $this->setFilters($this->configuration->getFilterDefaults());

      $this->redirect('user/index');
  }

  //// активные
   public function executeFilterActive(sfWebRequest $request)
  {
    $u = Doctrine::getTable('sfGuardUser')->find($request->getParameter('id'));
    $pf = $u->getProfile();
    $this->getUser()->setAttribute(
	'user.filters',
	array('status_id'=>1),
	'admin_module'
	);
	$this->redirect('user/index');
  }

   public function executeFilterPartnerActive(sfWebRequest $request)
  {
    $u = Doctrine::getTable('sfGuardUser')->find($request->getParameter('id'));
    $pf = $u->getProfile();
    $this->getUser()->setAttribute(
	'user.filters',
	array('status_id'=>1,'partner_id'=>array('text'=>$request->getParameter('id'))),
	'admin_module'
	);
	$this->redirect('user/index');
  }

   public function executeFilterPartnerNoapprove(sfWebRequest $request)
  {
    $u = Doctrine::getTable('sfGuardUser')->find($request->getParameter('id'));
    $pf = $u->getProfile();
    $this->getUser()->setAttribute(
	'user.filters',
	array('status_id'=>2,'partner_id'=>array('text'=>$request->getParameter('id'))),
	'admin_module'
	);
	$this->redirect('user/index');
  }

  //// на утверждении
   public function executeFilterOnapprove(sfWebRequest $request)
  {
    
    $this->getUser()->setAttribute(
	'user.filters',
	array('status_id'=>2),
	'admin_module'
	);
	$this->redirect('user/index');
  }

  
    //// измененные
   public function executeFilterNotactive(sfWebRequest $request)
  {
    
    $this->getUser()->setAttribute(
	'user.filters',
	array('status_id'=>4),
	'admin_module'
	);
	$this->redirect('user/index');
  }
  

  //// на удаление
   public function executeFilterOndelete(sfWebRequest $request)
  {

    $this->getUser()->setAttribute(
	'user.filters',
	array('status_id'=>5),
	'admin_module'
	);
	$this->redirect('user/index');
  }

    //// на деактивацию
   public function executeFilterOndeactivate(sfWebRequest $request)
  {

    $this->getUser()->setAttribute(
	'user.filters',
	array('status_id'=>4),
	'admin_module'
	);
	$this->redirect('user/index');
  }

      //// на активные
   public function executeFilterNoactive(sfWebRequest $request)
  {

    $this->getUser()->setAttribute(
	'user.filters',
	array('status_id'=>3),
	'admin_module'
	);
	$this->redirect('user/index');
  }

  public function sendNotify($user)
   {
    
                   $m = NotifyTable::getNotify(11, $user->getCulture());
                  
                   if($m)
                   {


                           if($user->getCulture()=='ru')
                           {
                               $cat = __('каталог пользователей');
                           }
                           if($user->getCulture()=='en')
                           {
                               $cat = __('members catalogue');
                           }
                           if($user->getCulture()=='fr')
                           {
                               $cat = __('membres le catalogue');
                           }
                           if($user->getCulture()=='de')
                           {
                               $cat = __('mitglieder katalog');
                           }
                           if($user->getCulture()=='is')
                           {
                               $cat = __('catálogo de los miembros');
                           }



                       if($user->getGender()=='m')
                       {
                           if($user->getCulture()=='ru')
                           {
                               $gen = __('женщины');
                           }
                           if($user->getCulture()=='en')
                           {
                               $gen = __('women');
                           }
                           if($user->getCulture()=='fr')
                           {
                               $gen = __('femmes');
                           }
                           if($user->getCulture()=='de')
                           {
                               $gen = __('frauen');
                           }
                           if($user->getCulture()=='is')
                           {
                               $gen = __('mujeres');
                           }


                       }
                       else
                       {
                           if($user->getCulture()=='ru')
                           {
                               $gen = __('мужчина');
                           }
                           if($user->getCulture()=='en')
                           {
                               $gen = __('man');
                           }
                           if($user->getCulture()=='fr')
                           {
                               $gen = __('hommes');
                           }
                           if($user->getCulture()=='de')
                           {
                               $gen = __('männer');
                           }
                           if($user->getCulture()=='is')
                           {
                               $gen = __('hombres');
                           }
                       }


                       $arr = array(
                           '%link_login%' => link_to(url_for('http://'.$_SERVER['HTTP_HOST'].'/'.$user->getCulture().'/registration/enter?code='.$user->getSalt(),array('absolute' => true)),url_for('http://'.$_SERVER['HTTP_HOST'].'/'.$user->getCulture().'/registration/enter?code='.$user->getSalt(),array('absolute' => true))),
                           '%site%' => 'http://'.$_SERVER['HTTP_HOST'],
                           '%login%' => $user->getUsername(),
                           '%gender%' => $gen,
                           '%link%' => link_to(__('contuct us'),'contact/index',array('absolute' => true)),
                           '%name%' => $user->getProfile()->getFirstName().' '.$user->getProfile()->getLastName(),
                           '%gender_catalog%' => $cat,
                           '%password%' => $user->getPc()
                       );

                        $content =$m->parse2($arr,$user->getCulture());
                        
                        mailTools::send($user->getEmail(), $m->Translation[$user->getCulture()]->ititle, $content);

                   }





   }
   
    //// на деактивацию
   protected function Activatephotos($user)
  {
     $ph = Doctrine::getTable('Photo')->createQuery('a')->where('a.user_id=?',array($user->getId()))->execute();
	 foreach($ph as $p)
	 {
	   $p->setPub(true);
	   $p->save();
	 }
  }
  
  
    protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
         
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $profile = $form->save();
      $profile->setEmail($request->getParameter('profile')['email']);

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $profile)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@profile_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('user/edit?id='.$profile->getUserId());
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  


 
}
