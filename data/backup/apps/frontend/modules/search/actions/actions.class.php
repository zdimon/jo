<?php

/**
 * search actions.
 *
 * @package    levandos
 * @subpackage search
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class searchActions extends commonActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */



    public function executeAnniversary(sfWebRequest $request)
    {

        /*
        $q = Doctrine_Query::create()
            ->select('j.id')
            ->from('profile as j')
            ->where('((EXTRACT(MONTH FROM j.birthday ),
             EXTRACT(DAY FROM j.birthday )) IN (
             SELECT EXTRACT( MONTH FROM thedate.theday + s.a ) AS m,
             EXTRACT( DAY FROM thedate.theday + s.a ) AS d
             FROM
             (SELECT date ( v.column1 -(extract ( YEAR FROM v.column1 )-2000 ) * INTERVAL "1 year") as theday
                 FROM ( VALUES (date "2012-03-12" )) as v) as thedate,
                 GENERATE_SERIES(0, 6) AS s(a)
        )
    )')
            ->execute();
    */

        $dt = new sfDate();
        //$dt->subtractDay(15);

        if($this->getUser()->getGuardUser()->getProfile()->getGender()=='m')
        {
            $g = 'w';
        }
        else
        {
            $g = 'm';
        }
        $q = Doctrine_Manager::getInstance()->connection();

        $sql_string = "SELECT id
FROM
   jo_profile as people
WHERE
    ((EXTRACT(MONTH FROM people.birthday),
     EXTRACT(DAY FROM people.birthday)) IN (
        SELECT EXTRACT(MONTH FROM thedate.theday + s.a) AS m,
               EXTRACT(DAY FROM thedate.theday + s.a) AS d
        FROM
                (SELECT date (v.column1 -
                        (extract (YEAR FROM v.column1)-2000) * INTERVAL '1 year'
                       ) as theday
                 FROM (VALUES (date '".$dt->dump('Y-m-d')."')) as v) as thedate,
                 GENERATE_SERIES(0, 15) AS s(a)
        )
    ) and people.gender='".$g."'";

        $st = $q->execute($sql_string);
        $this->items = $st->fetchAll();

        $this->insertArrays();


    }

public function executeAdv(sfWebRequest $request)
  {
    if(sfConfig::get('app_reg_search')=='false' and !$this->getUser()->isAuthenticated()) $this->redirect ('access/onlyregister');
    $this->form = new advsearchForm();
  }

  public function executeIndex(sfWebRequest $request)
  {
      $this->autoenter();
      $this->checkAuthorization();
      //if(!$this->getUser()->isAuthenticated()) $this->redirect ('access/onlyregister');

      if($this->getUser()->getGuardUser()->getProfile()->getGender()=='m')
      {
          $this->gender = 'w';
      }
      else
      {
           $this->gender = 'm';
      }

      $q = Doctrine::getTable('Profile')
      ->createQuery('a')
      ->leftJoin('a.sfGuardUser s')
      ->where('a.is_active=? and a.status_id=1',array(true));

      /*
      if($this->getUser()->isAuthenticated())
      {
          if(sfConfig::get('app_not_same_gender')=='true')


              $q->addWhere('a.gender<>?',array($this->getUser()->getGuardUser()->getGender()));

      }
      */

      $q = $this->addCriteria($request, $q);
      $q = $this->addOrder($request, $q);

//      $pars = $_GET;
//      $this->arp = array();
//      foreach($pars as $k=>$v)
//      {
//         $this->arp[$k]=$v;
//      }
      //print_r($this->arp);

       $this->pager = new sfDoctrinePager('Profile',15);
       $this->pager->setQuery($q);
       $this->pager->setPage($request->getParameter('page', 1));
       $this->pager->init();

       $this->insertArrays();

      if($this->gender=='m' and !isset($this->title))
      {
          $this->title =  __('Men gallery');
      }
      else{
          $this->title =  __('Women gallery');
      }

      if($request->getParameter('is_online')=='true')
      {
         $this->title =  __('Only online');
      }
      if($request->getParameter('new')=='true')
      {
          $this->title =  __('New members');
      }
      if($request->getParameter('order')=='rating')
      {
          $this->title =  __('Most Viewed');
      }
      if($request->getParameter('order')=='unrating')
      {
          $this->title =  __('Less Viewed');
      }
      if($request->getParameter('type')=='top')
      {
          $this->title =  __('Top 100');
      }

      ////Устанавливаем заголовки
      $this->getResponse()->addMeta('description',  $this->title);
      $this->getResponse()->addMeta('keywords', $this->title);
      $this->getResponse()->addMeta('title',  $this->title);
      ////


  }

  protected function addCriteria($request, $q)
  {

      if($request->getParameter('age_from'))
      {
          $y = date('Y')-$request->getParameter('age_from');
          $dt_from = $y.'-'.date('m').'-'.date('d');
          $q->addWhere('a.birthday<?',array($dt_from));
      }

      if($request->getParameter('age_to'))
      {
          $y = date('Y')-$request->getParameter('age_to');
          $dt_from = $y.'-'.date('m').'-'.date('d');
          $q->addWhere('a.birthday>?',array($dt_from));
      }




       if($request->getParameter('with_photo'))
      {
          $q->addWhere('a.with_photo=?',array(true));
      }

       if($request->getParameter('with_video'))
      {
          $q->addWhere('a.with_video=?',array(true));
      }

       if($request->getParameter('is_online'))
      {
          $q->addWhere('s.is_online=?',array(true));
      }

       if($request->getParameter('country'))
      {
          $q->addWhere('a.country=?',array($request->getParameter('country')));
      }

      if($request->getParameter('user_id'))
      {
          $q->addWhere('a.user_id=?',array($request->getParameter('user_id')));
      }


      if($request->getParameter('subtype')=='bikini')
      {
          $q->addWhere('a.subtype=?',array('bikini'));
      }


      if($request->getParameter('subtype')=='top100')
      {
          $q->addWhere('a.subtype=?',array('top100'));
      }

      if($request->getParameter('children'))
      {
          $q->addWhere('a.children=?',array($request->getParameter('children')));
      }

      if($request->getParameter('body_type'))
      {
          $q->addWhere('a.body_type=?',array($request->getParameter('body_type')));
      }


      if($request->getParameter('height'))
      {
          $q->addWhere('a.height=?',array($request->getParameter('height')));
      }


      if($request->getParameter('weight'))
      {
          $q->addWhere('a.weight=?',array($request->getParameter('weight')));
      }



      if($request->getParameter('want_children'))
      {
          $q->addWhere('a.want_children=?',array($request->getParameter('want_children')));
      }

      if($request->getParameter('ethnicity'))
      {
          $q->addWhere('a.ethnicity=?',array($request->getParameter('ethnicity')));
      }

      if($request->getParameter('marital_status'))
      {
          $q->addWhere('a.marital_status=?',array($request->getParameter('marital_status')));
      }

      if($request->getParameter('education'))
      {
          $q->addWhere('a.education=?',array($request->getParameter('education')));
      }
      
      if($request->getParameter('smoker'))
      {
          $q->addWhere('a.smoker=?',array($request->getParameter('smoker')));
      }
      
      if($request->getParameter('drinker'))
      {
          $q->addWhere('a.drinker=?',array($request->getParameter('drinker')));
      }

      if($request->getParameter('looking_for_age_from'))
      {
          $q->addWhere('a.looking_for_age_from=?',array($request->getParameter('looking_for_age_from')));
      }

      if($request->getParameter('looking_for_age_to'))
      {
          $q->addWhere('a.looking_for_age_to=?',array($request->getParameter('looking_for_age_to')));
      }

      if($request->getParameter('city'))
      {
          $q->addWhere('a.city=?',array($request->getParameter('city')));
      }

      if($request->getParameter('hair_lenght'))
      {
          $q->addWhere('a.hair_lenght=?',array($request->getParameter('hair_lenght')));
      }

      if($request->getParameter('hair_color'))
      {
          $q->addWhere('a.hair_color=?',array($request->getParameter('hair_color')));
      }

      if($request->getParameter('language'))
      {
          $q->addWhere('(a.language1=? or a.language2=? or a.language3=?)',array($request->getParameter('language'),$request->getParameter('language'),$request->getParameter('language')));

      }

      if($request->getParameter('language_skill'))
      {
          $q->addWhere('(a.language_skill1=? or a.language_skill2=? or a.language_skill3=?)',array($request->getParameter('language_skill'),$request->getParameter('language_skill'),$request->getParameter('language_skill')));

      }



      if($request->getParameter('new')=='true')
      {
          $dt = new sfDate();
          $dt->subtractDay(21);
          $q->addWhere('s.created_at>?',array($dt->dump()));

      }

      if($request->getParameter('packet_id'))
      {
          $q->addWhere('a.packet_id=?',array($request->getParameter('packet_id')));
      }

      $q->addWhere('a.gender=?',array($this->gender));

      return $q;

  }

    protected function addOrder($request, $q)
    {
        if($request->getParameter('order')=='rating')
        {

            $q->orderBy('a.rating DESC');
        }
        elseif($request->getParameter('order')=='unrating')
        {

            $q->orderBy('a.rating ASC');
        }
        elseif($request->getParameter('order')=='new')
        {

            $q->orderBy('a.id DESC');
            $this->title =  __('New members');
        }

        else{
            $q->orderBy('a.id DESC');
        }

        return $q;

    }
    
}
