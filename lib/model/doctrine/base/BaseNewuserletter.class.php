<?php

/**
 * BaseNewuserletter
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property enum $to_gender
 * @property string $users_array
 * @property boolean $is_send
 * @property boolean $is_checked
 * @property date $date_send
 * 
 * @method integer       getId()          Returns the current record's "id" value
 * @method string        getTitle()       Returns the current record's "title" value
 * @method string        getContent()     Returns the current record's "content" value
 * @method enum          getToGender()    Returns the current record's "to_gender" value
 * @method string        getUsersArray()  Returns the current record's "users_array" value
 * @method boolean       getIsSend()      Returns the current record's "is_send" value
 * @method boolean       getIsChecked()   Returns the current record's "is_checked" value
 * @method date          getDateSend()    Returns the current record's "date_send" value
 * @method Newuserletter setId()          Sets the current record's "id" value
 * @method Newuserletter setTitle()       Sets the current record's "title" value
 * @method Newuserletter setContent()     Sets the current record's "content" value
 * @method Newuserletter setToGender()    Sets the current record's "to_gender" value
 * @method Newuserletter setUsersArray()  Sets the current record's "users_array" value
 * @method Newuserletter setIsSend()      Sets the current record's "is_send" value
 * @method Newuserletter setIsChecked()   Sets the current record's "is_checked" value
 * @method Newuserletter setDateSend()    Sets the current record's "date_send" value
 * 
 * @package    levandos
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseNewuserletter extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('jo_newuserletter');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('title', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             ));
        $this->hasColumn('content', 'string', 25000, array(
             'type' => 'string',
             'length' => 25000,
             ));
        $this->hasColumn('to_gender', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'man',
              1 => 'women',
             ),
             'default' => 'women',
             ));
        $this->hasColumn('users_array', 'string', 250000, array(
             'type' => 'string',
             'length' => 250000,
             ));
        $this->hasColumn('is_send', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('is_checked', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('date_send', 'date', null, array(
             'type' => 'date',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $i18n0 = new Doctrine_Template_I18n(array(
             'fields' => 
             array(
              0 => 'title',
              1 => 'content',
             ),
             ));
        $this->actAs($i18n0);
    }
}