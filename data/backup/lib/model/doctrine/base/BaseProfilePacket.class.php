<?php

/**
 * BaseProfilePacket
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property Doctrine_Collection $Profile
 * 
 * @method integer             getId()          Returns the current record's "id" value
 * @method string              getTitle()       Returns the current record's "title" value
 * @method string              getDescription() Returns the current record's "description" value
 * @method Doctrine_Collection getProfile()     Returns the current record's "Profile" collection
 * @method ProfilePacket       setId()          Sets the current record's "id" value
 * @method ProfilePacket       setTitle()       Sets the current record's "title" value
 * @method ProfilePacket       setDescription() Sets the current record's "description" value
 * @method ProfilePacket       setProfile()     Sets the current record's "Profile" collection
 * 
 * @package    levandos
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProfilePacket extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('jo_profile_packet');
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
        $this->hasColumn('description', 'string', 2500, array(
             'type' => 'string',
             'length' => 2500,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Profile', array(
             'local' => 'id',
             'foreign' => 'packet_id'));

        $i18n0 = new Doctrine_Template_I18n(array(
             'fields' => 
             array(
              0 => 'title',
              1 => 'description',
             ),
             ));
        $this->actAs($i18n0);
    }
}