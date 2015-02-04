<?php

/**
 * NotifyTranslation form base class.
 *
 * @method NotifyTranslation getObject() Returns the current form's model object
 *
 * @package    levandos
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNotifyTranslationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'icontent' => new sfWidgetFormTextarea(),
      'ititle'   => new sfWidgetFormInputText(),
      'file'     => new sfWidgetFormInputText(),
      'lang'     => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'icontent' => new sfValidatorString(array('max_length' => 100000, 'required' => false)),
      'ititle'   => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'file'     => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'lang'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('lang')), 'empty_value' => $this->getObject()->get('lang'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('notify_translation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NotifyTranslation';
  }

}
