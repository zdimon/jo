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

  public function preExecute()
  {
     parent:: preExecute();
     unset($_SESSION['access_payment']);

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

      $u = $p->getsfGuardUser();
     // if(!$u->getIsActive())
     // {

        $this->sendNotify($u);

     // }

      $dt = new sfDate();
      $dt->addDay(3);

      $p->setStatusId(1);
      $p->setIsActive(true);
      $p->setPacketId(4);
      $p->setMaxAbonent(5);
      $p->save();


      $u->setIsActive(true);
      $u->setDateExpire($dt->dump());
      $u->save();

	  $this->Activatephotos($u);



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

      $dt = new sfDate();
      $dt->addDay(3);


      $p->setStatusId(1);
      $p->setIsActive(true);
      $p->setPacketId(4);
      $p->setMaxAbonent(5);
      $p->save();

      $u = $p->getsfGuardUser();
      $u->setIsActive(true);
      $u->setDateExpire($dt->dump());
      $u->save();
	  $this->Activatephotos($u);
      $this->sendNotify($u);
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
      $this->form = new ProfileForm($p);
      if ($request->isMethod ( 'post' ))
		{

			$this->form->bind ( $request->getParameter ( 'profile' ));
			if ($this->form->isValid ()) {

                          $pf = $this->form->save();
						  

                          $this->redirect ( 'user/show?id=',$pf->getId() );

			}


		}


  }

  protected function buildQuery()
  {
    $query = parent::buildQuery();
    if(!$this->getUser()->hasCredential('admin'))
    {
        $query->andWhere(
                'partner_id = ?', $this->getUser()->getGuardUser()->getId()
                );
    }
    $query->andWhere('status_id<>6');
    return $query;
  }

   protected function processForm(sfWebRequest $request, sfForm $form)
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


 
}
