<?php

/**
 * Service filter form base class.
 *
 * @package    levandos
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseServiceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cost'         => new sfWidgetFormFilterInput(),
      'comission'    => new sfWidgetFormFilterInput(),
      'pub'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'show_man'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'show_partner' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'cost'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'comission'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'pub'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'show_man'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'show_partner' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('service_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Service';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'cost'         => 'Number',
      'comission'    => 'Number',
      'pub'          => 'Boolean',
      'show_man'     => 'Boolean',
      'show_partner' => 'Boolean',
    );
  }
}
