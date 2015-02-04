<?php

/**
 * ProfileTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ProfileTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ProfileTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Profile');
    }


     public static function getProfileById($id)
    {
           $p = Doctrine::getTable('Profile')
                ->createQuery('a')
                ->where('a.user_id=?',array($id))
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

        public  function retrieveBackendUserList(Doctrine_Query $q)
  {
    $rootAlias = $q->getRootAlias();
    $q->leftJoin($rootAlias . '.sfGuardUser sg');
    $q->leftJoin($rootAlias .'.Status st');
    $q->leftJoin('st.Translation str');
    return $q;
  }

          public static  function  getCntMans()
    {
        $cnt = Doctrine::getTable('Profile')
        ->createQuery('a')
        ->where('a.gender=? and status_id<>6',array('m'))
        ->count();
        return $cnt ;
    }

        public static  function  getCntWomans()
    {
        $cnt = Doctrine::getTable('Profile')
        ->createQuery('a')
        ->where('a.gender=? and status_id<>6',array('w'))
        ->count();
        return $cnt ;
    }

       public static  function  getCntNoapprove()
    {
        $cnt = Doctrine::getTable('Profile')
        ->createQuery('a')
        ->where('a.status_id=?',array(2))
        ->count();
        return $cnt ;
    }
	
	       public static  function  getCntOndelete()
    {
        $cnt = Doctrine::getTable('Profile')
        ->createQuery('a')
        ->where('a.status_id=?',array(5))
        ->count();
        return $cnt ;
    }
	
	       public static  function  getCntOndeactivate()
    {
        $cnt = Doctrine::getTable('Profile')
        ->createQuery('a')
        ->where('a.status_id=?',array(4))
        ->count();
        return $cnt ;
    }



    /// получение именинов
   public  static function  getAnniversaries($gender) {


       $dt = new sfDate();
      // $dt->subtractDay(15);

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
    ) and people.gender='".$gender."'";

       $st = $q->execute($sql_string);

       $items = $st->fetchAll();

       $arr = array();
       foreach ($items as $k=>$v)
       {
           $arr[] = Doctrine::getTable('Profile')->find($v['id']);

       }

           return $arr;


       }


    /// получение именинов
    public  static function  getAnniversariesTosend($gender) {


        $dt = new sfDate();
        // $dt->subtractDay(15);

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
    ) and people.gender='".$gender."' and people.birthday_mark<>'".date('Y')."'";

        $st = $q->execute($sql_string);

        $items = $st->fetchAll();

        $arr = array();
        foreach ($items as $k=>$v)
        {
            $arr[] = Doctrine::getTable('Profile')->find($v['id']);

        }

        return $arr;


    }




}