<?php

/**
 * mainpage actions.
 *
 * @package    levandos
 * @subpackage mainpage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mainpageActions extends commonActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

    /// херня
      $dom = $_SERVER['HTTP_HOST'];
      //echo $dom;
     if($dom == 'www.our-feeling.fr' or $dom == 'our-feeling.fr') $this->redirect('http://www.our-feeling.com/fr/home.html');
     if($dom == 'www.our-feeling.de' or $dom == 'our-feeling.de') $this->redirect('http://www.our-feeling.com/de/home.html');
     if($dom == 'www.our-feeling.us' or $dom == 'our-feeling.us') $this->redirect('http://www.our-feeling.com/en/home.html');
     if($dom == 'www.our-feeling.es' or $dom == 'our-feeling.es') $this->redirect('http://www.our-feeling.com/is/home.html');


    $this->page = Doctrine::getTable('Page')->find(1);
    $this->insertArrays();
      $this->form = new qregForm();
      //$this->lform = new sfGuardFormSignin();




      if ($request->isMethod('post'))
      {

          $this->form->bind($request->getParameter('signin'));
          if ($this->form->isValid())
          {

              //// Выбрасываем из онлайнеа
              $t = time() - 3600;
              Doctrine_Query::create()
                  ->update('sfGuardUser')
                  ->set('is_online','false')
                  ->where('timer<?', array($t))
                  ->execute();



              $values = $this->form->getValues();
              $this->getUser()->signin($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);



              //// Check membership
              //echo strtotime($user->getDateExpire()).'-'.strtotime(date('Y-m-d'));
              $user = $this->getUser()->getGuardUser();
              if(strtotime($user->getDateExpire())<strtotime(date('Y-m-d')) and $user->getGender()=='m')
              {

                  $pf = $user->getProfile();
                  $pf->setPacketId(1);
                  $pf->save();

              }

              /////


              // always redirect to a URL set in app.yml
              // or to the referer
              // or to the homepage

              $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $request->getReferer());
              //echo '$signinUrl-'.$signinUrl;
              //die;
              return $this->redirect('profile/member');

              return $this->redirect('' != $signinUrl ? $signinUrl : '@mainpage');
          }
      }

      if(!$this->getUser()->isAuthenticated())
      {
          $this->setLayout('splash_layout');
      }
      else{
          return $this->redirect('profile/member');
      }

  }

    public function executeTrans(sfWebRequest $request)
    {

    }




    public function executeSplash(sfWebRequest $request)
    {

    }

}
