<?php

/**
 * ProfileTranslation filter form base class.
 *
 * @package    levandos
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProfileTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'description'             => new sfWidgetFormFilterInput(),
      'ideal_match_description' => new sfWidgetFormFilterInput(),
      'hobbies'                 => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'description'             => new sfValidatorPass(array('required' => false)),
      'ideal_match_description' => new sfValidatorPass(array('required' => false)),
      'hobbies'                 => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('profile_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProfileTranslation';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'description'             => 'Text',
      'ideal_match_description' => 'Text',
      'hobbies'                 => 'Text',
      'lang'                    => 'Text',
    );
  }
}
