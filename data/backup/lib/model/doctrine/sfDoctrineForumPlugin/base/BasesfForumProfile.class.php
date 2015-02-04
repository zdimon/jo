<?php

/**
 * BasesfForumProfile
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $sf_guard_user_id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $email_address
 * @property string $image
 * @property sfGuardUser $User
 * 
 * @method integer        getSfGuardUserId()    Returns the current record's "sf_guard_user_id" value
 * @method string         getFirstName()        Returns the current record's "first_name" value
 * @method string         getMiddleName()       Returns the current record's "middle_name" value
 * @method string         getLastName()         Returns the current record's "last_name" value
 * @method string         getEmailAddress()     Returns the current record's "email_address" value
 * @method string         getImage()            Returns the current record's "image" value
 * @method sfGuardUser    getUser()             Returns the current record's "User" value
 * @method sfForumProfile setSfGuardUserId()    Sets the current record's "sf_guard_user_id" value
 * @method sfForumProfile setFirstName()        Sets the current record's "first_name" value
 * @method sfForumProfile setMiddleName()       Sets the current record's "middle_name" value
 * @method sfForumProfile setLastName()         Sets the current record's "last_name" value
 * @method sfForumProfile setEmailAddress()     Sets the current record's "email_address" value
 * @method sfForumProfile setImage()            Sets the current record's "image" value
 * @method sfForumProfile setUser()             Sets the current record's "User" value
 * 
 * @package    levandos
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasesfForumProfile extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_forum_profile');
        $this->hasColumn('sf_guard_user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('first_name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('middle_name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('last_name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('email_address', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('image', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'sf_guard_user_id',
             'foreign' => 'id'));
    }
}