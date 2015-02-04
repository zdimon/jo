<?php

/**
 * sfGuardUser form.
 *
 * @package    levandos
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class qregForm extends PluginsfGuardUserForm
{
  public function configure()
  {

      unset(

			$this['salt'],
                        $this['is_online'],
                        $this['timer'],
                        $this['image'],
                        $this['account'],
			$this['is_super_admin'],
                        $this['is_active'],
			$this['permissions_list'],
                        $this['created_at'],
                        $this['updated_at'],
                        $this['last_login'],
                        $this['groups_list'],
                        $this['is_partner'],
                        $this['pc'],
                        $this['real_name'],
			$this['algorithm']

		);




               // $this->widgetSchema['birthday'] = new sfWidgetFormDateJQueryUI();
                $this->widgetSchema['birthday'] = new sfWidgetFormI18nDate(array('culture' =>sfContext::getInstance()->getUser()->getCulture(),'years' => myUser::getYears()));
                $this->widgetSchema['password'] = new sfWidgetFormInputPassword(array(),array('style'=>'width: 240px'));
                $this->widgetSchema['email'] = new sfWidgetFormInput(array(),array('style'=>'width: 240px'));
                $this->widgetSchema['username'] = new sfWidgetFormInput(array(),array('style'=>'width: 240px'));
                $this->widgetSchema['culture'] = new sfWidgetFormInputHidden(array(),array('value'=>sfContext::getInstance()->getUser()->getCulture()));
                $this->widgetSchema['partner_id'] =  new sfWidgetFormInputHidden();
                $this->widgetSchema['country'] =  new sfWidgetFormI18nChoiceCountry(array('culture' =>sfContext::getInstance()->getUser()->getCulture()),array('style'=>'width: 250px'));

                $this->widgetSchema['culture'] =  new sfWidgetFormChoice(array('expanded'=>false,'choices' => array('en'=>__('English'),'ru'=>__('Russian'),'fr'=>__('French'))));


      $this->widgetSchema['captcha'] = new sfWidgetCaptchaGD();
      $this->validatorSchema['captcha'] = new sfCaptchaGDValidator(array('length' => 4), array('required'=>__('Required field.')));


                $this->widgetSchema['gender'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => array(''=>'','m'=>__('Man'), 'w'=>__('Woman'))));

                $this->widgetSchema->setHelps(array(
  		        'username'   => __('Логин должен быть уникальным и быть от 2 до 20 знаков.'),
                'password'   => __('От 5 до 25 знаков.'),
                'password2'   => __('Повторите пароль.'),
                'real_name'   => __('Будет показываться другим пользователям.'),
                'email'   => __('Должен быть действительным.'),
  	         ));


      $this->widgetSchema->setLabels(array(
          'username'   => __('Login'),
          'password'   => __('Password'),
          'country'   => __('Country'),
          'email'   => __('Email'),
          'birthday'   => __('Birthday'),
          'gender'   => __('Gender'),
          'culture'   => __('Language'),
          'captcha'   => __('Code'),
      ));


                $this->validatorSchema ['username'] =  new sfValidatorAnd(array(
                new sfValidatorString(array('min_length' => 2, 'max_length' => 20),array('min_length'=>'минимум 2 символа','max_length'=>'максимум 20 символов','required'=>'поле обязательно')),
                new sfValidatorRegex(array('pattern' => '/^[a-zA-Z]([a-zA-Z0-9._-]+)$/'), array('invalid' => 'логин "%value%" введен неверно','required'=>'поле обязательно')),

              ));
                
                
                                    // post validator
                $this->validatorSchema->setPostValidator(
                       new sfValidatorAnd(array(
        
                           new sfValidatorDoctrineUnique(array('model'  => 'sfGuardUser', 'column' => 'username'),    array(
        'invalid'       => __('This username already exist, please, fill anotherone'),
    ) ),
                            new sfValidatorDoctrineUnique(array('model'  => 'sfGuardUser', 'column' => 'email'),    array(
        'invalid'       => __('This email already exist, please, fill anotherone'),
    ) )
                            ))
                );
                


              // $this->validatorSchema ['password'] = new sfValidatorString(array('min_length' => 5, 'max_length' => 25),array('min_length'=>'минимум 5 символов','required'=>'поле обязательно'));

                    // post validator
               // $this->validatorSchema->setPostValidator(
              //    new sfValidatorDoctrineUnique(array('model'  => 'sfGuardUser', 'column' => 'username'))
              //  );

                //if($this->getObject()->getGender()=='m')
                $this->validatorSchema['is_agree'] = new sfValidatorString(array('required' => true),array('required'=>__('Egreement required.')));
                //$this->validatorSchema['gender'] = new sfValidatorChoice(array('choices' => array('m','w')));
                $this->validatorSchema['birthday'] = new sfValidatorDate(array('required' => true),array('required'=>__('Required field.')));
                // $this->validatorSchema['gender'] = new sfValidatorDate(array('required' => true),array('required'=>__('Required field.')));
                 
                $this->validatorSchema ['gender'] = new sfValidatorString(array('required' => true),array('required'=>__('Required field.')));

                $this->widgetSchema->moveField('email', 'after', 'country');

                $this->validatorSchema->setOption('allow_extra_fields', true);

                $custom_decorator = new sfWidgetFormSchemaFormatterqregListReg($this->getWidgetSchema());
                $this->getWidgetSchema()->addFormFormatter('deflist', $custom_decorator);
                $this->getWidgetSchema()->setFormFormatterName('deflist');
               

  }
 	

}

class sfWidgetFormSchemaFormatterqregListReg extends sfWidgetFormSchemaFormatter {
    protected
      $rowFormat                 = '<div class="row">%label%%field%%error%%help%%hidden_fields%</div>',
      $helpFormat                = '<span class="help">%help%</span>',
      $errorRowFormat            = '<div class="error">Errors:%errors%</div>',
      $errorListFormatInARow     = '<ul class="error_list">%errors%</ul>',
      $errorRowFormatInARow      = '<li>%error%</li>',
      $namedErrorRowFormatInARow = '<li>%name%: %error%</li>',
      $decoratorFormat           = '<dl id="formContainer">%content%</dl>';
}
