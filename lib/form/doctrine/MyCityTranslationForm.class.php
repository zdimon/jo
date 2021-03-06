<?php

/**
 * MyCityTranslation form.
 *
 * @package    levandos
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MyCityTranslationForm extends BaseMyCityTranslationForm
{
  public function configure()
  {
       $this->widgetSchema['country'] =  new sfWidgetFormInput(array(),array('style'=>'width: 300px'));
       $this->widgetSchema['city'] =  new sfWidgetFormInput(array(),array('style'=>'width: 300px'));
       $this->widgetSchema['content'] =  new sfWidgetFormTextarea(array(),array('style'=>'width: 300px; height: 200px'));
      
              $this->validatorSchema['city'] = new sfValidatorString(array('required' => true),array('required'=>__('Поле обязательно.')));
        $this->validatorSchema['country'] = new sfValidatorString(array('required' => true),array('required'=>__('Поле обязательно.')));
        $this->validatorSchema['content'] = new sfValidatorString(array('required' => true),array('required'=>__('Поле обязательно.')));
        
  }
}
