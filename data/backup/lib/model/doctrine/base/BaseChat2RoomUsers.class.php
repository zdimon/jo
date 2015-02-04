<?php

/**
 * BaseChat2RoomUsers
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property boolean $aproved
 * @property integer $room_id
 * @property integer $user_id
 * @property integer $last_active
 * @property Chat2Room $Room
 * @property sfGuardUser $User
 * 
 * @method integer        getId()          Returns the current record's "id" value
 * @method boolean        getAproved()     Returns the current record's "aproved" value
 * @method integer        getRoomId()      Returns the current record's "room_id" value
 * @method integer        getUserId()      Returns the current record's "user_id" value
 * @method integer        getLastActive()  Returns the current record's "last_active" value
 * @method Chat2Room      getRoom()        Returns the current record's "Room" value
 * @method sfGuardUser    getUser()        Returns the current record's "User" value
 * @method Chat2RoomUsers setId()          Sets the current record's "id" value
 * @method Chat2RoomUsers setAproved()     Sets the current record's "aproved" value
 * @method Chat2RoomUsers setRoomId()      Sets the current record's "room_id" value
 * @method Chat2RoomUsers setUserId()      Sets the current record's "user_id" value
 * @method Chat2RoomUsers setLastActive()  Sets the current record's "last_active" value
 * @method Chat2RoomUsers setRoom()        Sets the current record's "Room" value
 * @method Chat2RoomUsers setUser()        Sets the current record's "User" value
 * 
 * @package    levandos
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseChat2RoomUsers extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('jo_chat2_room_users');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('aproved', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('room_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('last_active', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Chat2Room as Room', array(
             'local' => 'room_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}