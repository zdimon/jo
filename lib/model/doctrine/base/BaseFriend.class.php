<?php

/**
 * BaseFriend
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $user_id
 * @property integer $friend_id
 * @property integer $status_id
 * @property boolean $del_user
 * @property boolean $del_friend
 * @property boolean $is_read_user
 * @property boolean $is_read_friend
 * @property string $contact
 * @property integer $from_partner_id
 * @property integer $to_partner_id
 * @property boolean $request_video
 * @property boolean $accept_video
 * @property boolean $read_accept
 * @property boolean $popup_add
 * @property boolean $popup_match
 * @property sfGuardUser $User
 * @property sfGuardUser $Friend
 * @property StatusFriend $Status
 * 
 * @method integer      getId()              Returns the current record's "id" value
 * @method integer      getUserId()          Returns the current record's "user_id" value
 * @method integer      getFriendId()        Returns the current record's "friend_id" value
 * @method integer      getStatusId()        Returns the current record's "status_id" value
 * @method boolean      getDelUser()         Returns the current record's "del_user" value
 * @method boolean      getDelFriend()       Returns the current record's "del_friend" value
 * @method boolean      getIsReadUser()      Returns the current record's "is_read_user" value
 * @method boolean      getIsReadFriend()    Returns the current record's "is_read_friend" value
 * @method string       getContact()         Returns the current record's "contact" value
 * @method integer      getFromPartnerId()   Returns the current record's "from_partner_id" value
 * @method integer      getToPartnerId()     Returns the current record's "to_partner_id" value
 * @method boolean      getRequestVideo()    Returns the current record's "request_video" value
 * @method boolean      getAcceptVideo()     Returns the current record's "accept_video" value
 * @method boolean      getReadAccept()      Returns the current record's "read_accept" value
 * @method boolean      getPopupAdd()        Returns the current record's "popup_add" value
 * @method boolean      getPopupMatch()      Returns the current record's "popup_match" value
 * @method sfGuardUser  getUser()            Returns the current record's "User" value
 * @method sfGuardUser  getFriend()          Returns the current record's "Friend" value
 * @method StatusFriend getStatus()          Returns the current record's "Status" value
 * @method Friend       setId()              Sets the current record's "id" value
 * @method Friend       setUserId()          Sets the current record's "user_id" value
 * @method Friend       setFriendId()        Sets the current record's "friend_id" value
 * @method Friend       setStatusId()        Sets the current record's "status_id" value
 * @method Friend       setDelUser()         Sets the current record's "del_user" value
 * @method Friend       setDelFriend()       Sets the current record's "del_friend" value
 * @method Friend       setIsReadUser()      Sets the current record's "is_read_user" value
 * @method Friend       setIsReadFriend()    Sets the current record's "is_read_friend" value
 * @method Friend       setContact()         Sets the current record's "contact" value
 * @method Friend       setFromPartnerId()   Sets the current record's "from_partner_id" value
 * @method Friend       setToPartnerId()     Sets the current record's "to_partner_id" value
 * @method Friend       setRequestVideo()    Sets the current record's "request_video" value
 * @method Friend       setAcceptVideo()     Sets the current record's "accept_video" value
 * @method Friend       setReadAccept()      Sets the current record's "read_accept" value
 * @method Friend       setPopupAdd()        Sets the current record's "popup_add" value
 * @method Friend       setPopupMatch()      Sets the current record's "popup_match" value
 * @method Friend       setUser()            Sets the current record's "User" value
 * @method Friend       setFriend()          Sets the current record's "Friend" value
 * @method Friend       setStatus()          Sets the current record's "Status" value
 * 
 * @package    levandos
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFriend extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('jo_friend');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('friend_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('status_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('del_user', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('del_friend', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('is_read_user', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('is_read_friend', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('contact', 'string', 10000, array(
             'type' => 'string',
             'length' => 10000,
             ));
        $this->hasColumn('from_partner_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('to_partner_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('request_video', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('accept_video', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('read_accept', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('popup_add', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('popup_match', 'boolean', null, array(
             'type' => 'boolean',
             'default' => true,
             ));


        $this->index('is_read_user', array(
             'fields' => 
             array(
              0 => 'is_read_user',
             ),
             ));
        $this->index('is_read_friend', array(
             'fields' => 
             array(
              0 => 'is_read_friend',
             ),
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('sfGuardUser as Friend', array(
             'local' => 'friend_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('StatusFriend as Status', array(
             'local' => 'status_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}