<?php

/**
 * MyCityTranslation filter form base class.
 *
 * @package    levandos
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMyCityTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'country' => new sfWidgetFormFilterInput(),
      'city'    => new sfWidgetFormFilterInput(),
      'content' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'country' => new sfValidatorPass(array('required' => false)),
      'city'    => new sfValidatorPass(array('required' => false)),
      'content' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('my_city_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MyCityTranslation';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'country' => 'Text',
      'city'    => 'Text',
      'content' => 'Text',
      'lang'    => 'Text',
    );
  }
}
