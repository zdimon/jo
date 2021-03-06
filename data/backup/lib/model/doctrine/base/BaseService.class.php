<?php

/**
 * BaseService
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property decimal $cost
 * @property decimal $comission
 * @property boolean $pub
 * @property boolean $show_man
 * @property boolean $show_partner
 * @property Doctrine_Collection $Payment
 * 
 * @method integer             getId()           Returns the current record's "id" value
 * @method string              getTitle()        Returns the current record's "title" value
 * @method string              getDescription()  Returns the current record's "description" value
 * @method decimal             getCost()         Returns the current record's "cost" value
 * @method decimal             getComission()    Returns the current record's "comission" value
 * @method boolean             getPub()          Returns the current record's "pub" value
 * @method boolean             getShowMan()      Returns the current record's "show_man" value
 * @method boolean             getShowPartner()  Returns the current record's "show_partner" value
 * @method Doctrine_Collection getPayment()      Returns the current record's "Payment" collection
 * @method Service             setId()           Sets the current record's "id" value
 * @method Service             setTitle()        Sets the current record's "title" value
 * @method Service             setDescription()  Sets the current record's "description" value
 * @method Service             setCost()         Sets the current record's "cost" value
 * @method Service             setComission()    Sets the current record's "comission" value
 * @method Service             setPub()          Sets the current record's "pub" value
 * @method Service             setShowMan()      Sets the current record's "show_man" value
 * @method Service             setShowPartner()  Sets the current record's "show_partner" value
 * @method Service             setPayment()      Sets the current record's "Payment" collection
 * 
 * @package    levandos
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseService extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('jo_service');
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
        $this->hasColumn('cost', 'decimal', null, array(
             'type' => 'decimal',
             'scale' => 2,
             ));
        $this->hasColumn('comission', 'decimal', null, array(
             'type' => 'decimal',
             'scale' => 2,
             ));
        $this->hasColumn('pub', 'boolean', null, array(
             'type' => 'boolean',
             'default' => true,
             ));
        $this->hasColumn('show_man', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('show_partner', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Payment', array(
             'local' => 'id',
             'foreign' => 'service_id'));

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