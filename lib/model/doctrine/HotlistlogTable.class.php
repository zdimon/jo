<?php

/**
 * HotlistlogTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class HotlistlogTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object HotlistlogTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Hotlistlog');
    }

    public static  function getCurrentAmmountAbonents($user)
    {

        $p = Doctrine::getTable('Hotlistlog')
            ->createQuery('a')
            ->where('a.from_id=?',array($user->getId()))
            ->count();
        return $p;
    }

    public static function  checkUser($from_id,$to_id)
    {
      //echo $from_id.'-'.$to_id;

    $p = Doctrine::getTable('Hotlistlog')
    ->createQuery('a')
    ->where('a.from_id=? and to_id=?',array($from_id, $to_id))
    ->count();
    if($p>0) return true;
    return false;

    }


    public static function  hasCor($user_id)
    {

        $p = Doctrine::getTable('Hotlistlog')
            ->createQuery('a')
            ->where('a.from_id=? or to_id=?',array($user_id,$user_id))
            ->count();
        if($p>0) return true;
        return false;

    }


}
