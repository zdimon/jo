<?php

/**
 * account actions.
 *
 * @package    levandos
 * @subpackage account
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class accountActions extends commonActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */

     public function executeSuccess(sfWebRequest $request)
    {
         echo 'success';
         die;
     }

     public function executeFail(sfWebRequest $request)
    {
         echo 'fail';
         die;    
     }     
     
     
    public function executeHistory(sfWebRequest $request)
    {
        $this->checkAuthorization();
        
            ////Устанавливаем заголовки
		    $this->getResponse()->addMeta('description',  __('Purchase history'));
		    $this->getResponse()->addMeta('keywords', __('Purchase history'));
		    $this->getResponse()->addMeta('title',  __('Purchase history'));
	   ////

        ///Выбираем оплаты услуг

            $q = Doctrine::getTable('Billing')
            ->createQuery('a')
            ->where('a.user_id=?',$this->getUser()->getGuardUser()->getId())
            ->orderBy('a.id DESC');

        $this->pager = new sfDoctrinePager('Billing',20);
        $this->pager->setQuery($q);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();


        ///Выбираем расходы

        $q = Doctrine::getTable('Payment')
            ->createQuery('a')
            ->where('a.user_id=?',$this->getUser()->getGuardUser()->getId())
            ->orderBy('a.id DESC');

        $this->pagerp = new sfDoctrinePager('Payment',20);
        $this->pagerp->setQuery($q);
        $this->pagerp->setPage($request->getParameter('page', 1));
        $this->pagerp->init();

    }


  public function executeIndex(sfWebRequest $request)
  {
      
                  ////Устанавливаем заголовки
		    $this->getResponse()->addMeta('description',  __('Upgrade membership'));
		    $this->getResponse()->addMeta('keywords', __('Upgrade membership'));
		    $this->getResponse()->addMeta('title',  __('Upgrade membership'));
	   ////
      
      $this->checkAuthorization();
      if(!$this->getUser()->isAuthenticated()) $this->redirect ('access/onlyregister');
      // Выбираем типы пополнений
      $this->tbil = Doctrine::getTable('BillingType')
              ->createQuery('a')
              ->orderBy('a.summa DESC')
              ->execute();

      // Выбираем услуги
      $this->s = Doctrine::getTable('Service')
              ->createQuery('a')
              ->where('a.pub=? and a.show_man=?',array(true,true))
              ->execute();

      ///Выбираем пополнения



      /*
       *         $q = Doctrine::getTable('Payment')
            ->createQuery('a')
            ->leftJoin('a.Service s')
            ->where('a.user_id=? and s.show_man=?',array($this->getUser()->getGuardUser()->getId(),true))
            ->orderBy('a.id DESC');

       */
    
  }

  public function executeAdd(sfWebRequest $request)
  {
      $this->checkAuthorization();
    $t = Doctrine::getTable('BillingType')->find($request->getParameter('type'));



        $user = $this->getUser()->getGuardUser();
        $profile = $user->getProfile();
        if($user->getDateExpire()>date('Y-m-d'))
        {
            $dt = new sfDate($user->getDateExpire());
        }
        else
        {
            $dt = new sfDate();
        }


        switch ($request->getParameter('term')) {
            case 1:
                $date_expire = $dt->addDay(30);
                $summa = $t->getSumma();

                break;
            case 2:
                $date_expire = $dt->addDay(60);
                $summa = $t->getSumma()*2;
                break;
            case 3:
                $date_expire = $dt->addDay(90);
                $summa = $t->getSumma()*3;
                break;

        }

      switch ($request->getParameter('type')) {
          case 1:
              $tp = 4;
              $profile->setMaxAbonent(1000);
              $profile->save();
              $mess = __('Your membership has been upgrated.');
              break;
          case 2:
              $tp = 2;
              $profile->setMaxAbonent(5);
              $profile->save();
              $mess = __('Your membership has been upgrated.');
              break;
          case 3:
              $tp = 3;
              $profile->setMaxAbonent(5);
              $profile->save();
              $mess = __('Your membership has been upgrated.');
              break;
          case 4:
              $tp = 5;
              $mess = __('Your membership has been upgrated.');
              break;          
          case 00:
              $tp = 0;
              $user->setAccount($user->getAccount()+$request->getParameter('term'));
              $user->save();
              $mess = __('Your account has been refunded.');
              break;

      }



      if($tp!=0)
      {
      $pf = $user->getProfile();
      $pf->setPacketId($tp);
      $pf->save();


     // $user->setAccount($user->getAccount()+$t->getCredit());
      $user->setDateExpire($date_expire->dump());
      $user->save();


        $b = new Billing();
        $b->setTitle($t->getTitle());
        $b->setTypeId($t->getId());
        $b->setUserId($user->getId());
        $b->setSumma($summa);
        //$b->setBalance($user->getAccount());
        //$b->setCredit($t->getCredit());
        $b->save();

      }




    $this->getUser ()->setFlash ( 'message', $mess );
    $this->redirect('account/index');
  }

  protected function getType($summa)
  {
      $p = Doctrine::getTable('BillingType')
      ->createQuery('a')
              ->where('a.summa=?',$summa)
              ->fetchOne();
      if($p)
      {
          return $p;
      }
      else
      {
          return false;
      }
  }


  public function executeIpn(sfWebRequest $request)
  {
        $str = 'par';
        foreach($_POST as $k=>$v)
        {
            $str.=$k.'='.$v;
        }
        $user = Doctrine::getTable('sfGuardUser')->find($_POST['curUserId']);
        if($user)
        {
         $summa = $this->getCredit($_POST['invoiceAmount']);
            $user->setAccount($user->getAccount()+$summa);
            $user->save();

        $b = new Billing();
        $b->setTitle('Payment from Plimus');
        $b->setTypeId(1);
        $b->setUserId($user->getId());
        $b->setSumma($summa);
        $b->setBalance($user->getAccount());
       // $b->setCredit($t->getCredit());
        $b->save();



        }
  }

   public function getCredit($s)
  {

       if($s==1)
       {
           return 1;
       }

       if($s==15)
       {
           return 10;
       }
       if($s==42)
       {
           return 30;
       }

       if($s==100)
       {
           return 100;
       }

       return 0;

   }

}
