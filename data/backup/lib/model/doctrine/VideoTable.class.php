<?php

/**
 * VideoTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class VideoTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object VideoTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Video');
    }

  public function retrieveBackendVideoList(Doctrine_Query $q)
  {
    $rootAlias = $q->getRootAlias();
    $q->leftJoin($rootAlias . '.User sg');
    return $q;
  }

    public static function getUserVideo($guard_user)
    {
        $video = Doctrine::getTable('Video')
            ->createQuery('a')
            ->where('a.user_id=? and pub=?',array($guard_user->getId(),true))
            ->execute();
        return $video;
    }

}