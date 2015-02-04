<?php

/**
 * registration actions.
 *
 * @package    levandos
 * @subpackage registration
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class registrationActions extends commonActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */

    ///Вход
    public function executeEnter()
    {

        if($this->getRequestParameter('code'))
        {
            $user = Doctrine::getTable('sfGuardUser')
                ->createQuery('a')
                ->where('a.salt=?',array($this->getRequestParameter('code')))
                ->fetchOne();
            if($user)
            {


                $this->getContext()->getUser()->signIn($user);
                $this->redirect ( 'profile/member');

            }



            $this->redirect('@mainpage');

        }


    }

    public function executeFinish()
    {
        $this->checkAuthorization();
        $user = $this->getUser()->getGuardUser();
        $this->sendNotifyFinish($user);
        $this->getUser()->signout();

    }

  public function executeIndex(sfWebRequest $request)
  {
    /// Выбираем текст

    $this->setLayout('splash_layout');
    $this->message = Doctrine::getTable('Page')->find(6);

    $u = new sfGuardUser();
    if($this->getUser()->isAuthenticated() and $this->getUser()->getGuardUser()->getIsPartner())
    {
        $u->setPartnerId($this->getUser()->getGuardUser()->getId());
    }
    if($request->getParameter ( 'gender' )=='m')
    {
        $u->setGender('m');
    }
    else
    {
        $u->setGender('w');
    }

    $this->form = new qregForm($u);
    if ($request->isMethod ( 'post' ))
		{
			$this->form->bind ( $request->getParameter ( 'sf_guard_user' ) );
			if ($this->form->isValid ()) {
                          $pars = $request->getParameter ( 'sf_guard_user' );
                          $u = $this->form->save();



                          if($u->getGender()=='w' and $u->getPartnerId()===null)
                          {
                              $u->setPartnerId(1);
                          }
                          $u->save();
                          /// adding id to login
                          $u->setUsername($u->getUsername().$u->getId());
                          $u->save();

                          ///создаем профайл
                            $p = new Profile();
                            $p->setUserId($u->getId());
                            $p->setGender($u->getGender());
                            $p->setRealName($pars['username']);
                            //$arr = explode('/',$pars['birthday']);

                            $p->setBirthday($pars['birthday']['year'].'-'.$pars['birthday']['month'].'-'.$pars['birthday']['day']);
                            $p->setStatusId(2);
                            $p->save();
                          ///
                          $this->getUser()->getCulture($u->getCulture());
                          //$this->getUser ()->setFlash ( 'message', __('Thanks, please check your email box, we sent you a link to activate your email (%1%). Please click on this link to continue your registration.', array('%1%'=>$u->getEmail())) );
                $this->getUser ()->setFlash ( 'message', __('Thank you, please fill the form of your profile.') );
                   $this->success =   __('Thanks, please check your email box, we sent you a link to activate your email (%1%). Please click on this link to continue your registration.', array('%1%'=>$u->getEmail()));
                  $this->sendNotify($u);
                  //$this->getUser()->signin($u);
		          //$this->redirect ( 'profile/edit?id='.$u->getId());
                 // $this->redirect ( 'mainpage/index');

			}

		}

  }

  ///Активация профайла
  public function executeActivate()
  {

  	if($this->getRequestParameter('code'))
  	{
             $user = Doctrine::getTable('sfGuardUser')
              ->createQuery('a')
              ->where('a.salt=?',array($this->getRequestParameter('code')))
              ->fetchOne();
             if($user)
             {
                mailTools::send(sfConfig::get('app_email_admin'), 'Activation user', 'User ['.$user->getId().'] follow for activate link.');
                 $user->setIsActive(true);
                 $user->save();
                 $this->getUser ()->setFlash ( 'message', __('Thank you. Your email was confirmed! Please fill the form.') );
                 $this->getContext()->getUser()->signIn($user);
                 $this->getUser()->setCulture($user->getCulture());
                 $this->redirect ( 'profile/step1');

             }
            //  $this->getContext()->getUser()->signIn($user);


             $this->redirect('@mainpage');

  	}


  }


    public function sendNotify($user)
    {
        $m = NotifyTable::getNotify(1, $user->getCulture());

        if($m)
        {
            $arr = array(
                '%link%' => link_to(url_for('registration/activate?code='.$user->getSalt(),array('absolute' => true)),'registration/activate?code='.$user->getSalt(),array('absolute' => true)),
                '%site%' => 'http://'.$_SERVER['HTTP_HOST'],
                '%login%' => $user->getUsername(),
                '%password%' => $user->getPc(),
                '%link_char%' => url_for('registration/activate?code='.$user->getSalt(),array('absolute' => true))
            );

            $content =$m->parse2($arr,$user->getCulture());

            mailTools::send($user->getEmail(), $m->Translation[$user->getCulture()]->ititle, $content);

        }

        $m = NotifyTable::getNotify(2, $this->getUser()->getCulture());
        if($m)
        {
            if($user->getPartnerId()>0)
            {
                $partner = Doctrine::getTable('sfGuardUser')->find($user->getPartnerId());
            }
            else
            {
                $partner = Doctrine::getTable('sfGuardUser')->find(1);
            }
            $arr = array(
                '%link%' => link_to(__('Activation link'),'registration/activate?code='.$user->getSalt(),array('absolute' => true)),
                '%site%' => 'http://'.$_SERVER['HTTP_HOST'],
                '%login%' => $user->getUsername(),
                '%password%' => $user->getPc(),
                '%id%' => $user->getId(),
                '%partner%' => $partner,
                '%link_char%' => url_for('registration/activate?code='.$user->getSalt(),array('absolute' => true))
            );

            $content =$m->parse2($arr,$this->getUser()->getCulture());
            mailTools::send(sfConfig::get('app_email_admin'), $m->Translation[$user->getCulture()]->ititle, $content);
        }


    }


    public function sendNotifyFinish($user)
    {
        $m = NotifyTable::getNotify(12, $user->getCulture());

        if($m)
        {


            $arr = array(
                '%link%' => link_to(__('contuct us'),'contact/index',array('absolute' => true)),
                '%site%' => 'http://'.$_SERVER['HTTP_HOST'],
                '%login%' => $user->getUsername(),
                '%password%' => $user->getPc(),
                '%link_char%' => url_for('registration/activate?code='.$user->getSalt(),array('absolute' => true))
            );

            $content =$m->parse2($arr,$user->getCulture());

            mailTools::send($user->getEmail(), $m->Translation[$user->getCulture()]->ititle, $content);

        }




    }




}


