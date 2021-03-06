<?php

/**
 * BasesfForumTopic
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property integer $author
 * @property integer $hits
 * @property boolean $hide
 * @property boolean $close
 * @property integer $position
 * @property integer $category_id
 * @property integer $last_user
 * @property string $content
 * @property sfForumCategory $sfForumCategory
 * @property sfGuardUser $User
 * @property sfGuardUser $Lastuser
 * @property Doctrine_Collection $MessageTopic
 * 
 * @method string              getName()            Returns the current record's "name" value
 * @method integer             getAuthor()          Returns the current record's "author" value
 * @method integer             getHits()            Returns the current record's "hits" value
 * @method boolean             getHide()            Returns the current record's "hide" value
 * @method boolean             getClose()           Returns the current record's "close" value
 * @method integer             getPosition()        Returns the current record's "position" value
 * @method integer             getCategoryId()      Returns the current record's "category_id" value
 * @method integer             getLastUser()        Returns the current record's "last_user" value
 * @method string              getContent()         Returns the current record's "content" value
 * @method sfForumCategory     getSfForumCategory() Returns the current record's "sfForumCategory" value
 * @method sfGuardUser         getUser()            Returns the current record's "User" value
 * @method sfGuardUser         getLastuser()        Returns the current record's "Lastuser" value
 * @method Doctrine_Collection getMessageTopic()    Returns the current record's "MessageTopic" collection
 * @method sfForumTopic        setName()            Sets the current record's "name" value
 * @method sfForumTopic        setAuthor()          Sets the current record's "author" value
 * @method sfForumTopic        setHits()            Sets the current record's "hits" value
 * @method sfForumTopic        setHide()            Sets the current record's "hide" value
 * @method sfForumTopic        setClose()           Sets the current record's "close" value
 * @method sfForumTopic        setPosition()        Sets the current record's "position" value
 * @method sfForumTopic        setCategoryId()      Sets the current record's "category_id" value
 * @method sfForumTopic        setLastUser()        Sets the current record's "last_user" value
 * @method sfForumTopic        setContent()         Sets the current record's "content" value
 * @method sfForumTopic        setSfForumCategory() Sets the current record's "sfForumCategory" value
 * @method sfForumTopic        setUser()            Sets the current record's "User" value
 * @method sfForumTopic        setLastuser()        Sets the current record's "Lastuser" value
 * @method sfForumTopic        setMessageTopic()    Sets the current record's "MessageTopic" collection
 * 
 * @package    levandos
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasesfForumTopic extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_forum_topic');
        $this->hasColumn('name', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('author', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('hits', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('hide', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('close', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('position', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('category_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('last_user', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('content', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfForumCategory', array(
             'local' => 'category_id',
             'foreign' => 'id'));

        $this->hasOne('sfGuardUser as User', array(
             'local' => 'author',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('sfGuardUser as Lastuser', array(
             'local' => 'last_user',
             'foreign' => 'id'));

        $this->hasMany('sfForumMessage as MessageTopic', array(
             'local' => 'id',
             'foreign' => 'topic_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}