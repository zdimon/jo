<?php

/**
 * Profile form.
 *
 * @package    levandos
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class myProfileForm extends BaseProfileForm
{
  public function configure()
  {

              unset(
                        $this['i_can_receive'],
                        $this['can_resive_gift'],
                        $this['with_photo'],
                        $this['with_video'],
                        $this['created_at'],
                        $this['is_online'],
                        $this['subtype'],
                        $this['updated_at'],
			            $this['user_id'],
                        $this['gender'],
                        $this['photo'],
                        $this['is_active'],
                        $this['is_new_message'],
                        $this['is_new_favorite'],
                        $this['is_new_request'],
                        $this['is_new_gift'],
                        $this['is_new_hotlist'],
                        $this['is_new_friend'],
                        $this['status_id'],
                        $this['is_empty'],
                        $this['partner_id'],
                        $this['rating'],
              $this['birthday'],
              $this['scamer'],
              $this['cert'],
              $this['sub_message'],
              $this['sub_interest'],
              $this['sub_fav'],
              $this['sub_newsletter'],
              $this['cur_abonent'],
              $this['max_abonent'],
              $this['packet_id'],

			$this['algorithm']
		);

      $this->widgetSchema['height'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getHeight()));
      //$this->widgetSchema['birthday'] =  new sfWidgetFormI18nDate(array('culture' =>sfContext::getInstance()->getUser()->getCulture(),'years' => myUser::getYears()));
      $this->widgetSchema['body_type'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getBodyType()));


     // $this->widgetSchema['gender'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getGender()));
      $this->widgetSchema['country'] =  new sfWidgetFormI18nChoiceCountry(array('culture' =>sfContext::getInstance()->getUser()->getCulture()),array('style'=>'width: 250px'));
      $this->widgetSchema['children'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getChildren()));
      $this->widgetSchema['want_children'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getWantChildren()));
      $this->widgetSchema['where_children'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getWhereChildren()));
      $this->widgetSchema['ethnicity'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getEthnicity()));
      $this->widgetSchema['religion'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getReligion()));
      $this->widgetSchema['marital_status'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getMaritalStatus()));
      $this->widgetSchema['language1'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getLanguage()));
      $this->widgetSchema['language2'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getLanguage()));
      $this->widgetSchema['language3'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getLanguage()));
      $this->widgetSchema['language_skill1'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getLanguageSkills()));
      $this->widgetSchema['language_skill2'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getLanguageSkills()));
      $this->widgetSchema['language_skill3'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getLanguageSkills()));
      $this->widgetSchema['education'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getEducation()));
      $this->widgetSchema['income'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getIncome()));
      $this->widgetSchema['smoker'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getSmoker()));
      $this->widgetSchema['drinker'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getDrinker()));
      $this->widgetSchema['im'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getIm()));
      $this->widgetSchema['i_look_for_a'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getGender()));
      $this->widgetSchema['looking_for_age_from'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getAge()));
      $this->widgetSchema['looking_for_age_to'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getAge()));
      $this->widgetSchema['looking_for_a_height_from'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getHeight()));
      $this->widgetSchema['looking_for_a_height_to'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getHeight()));
      $this->widgetSchema['looking_for_a_body_type_from'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getVes()));
      $this->widgetSchema['looking_for_a_body_type_to'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getVes()));
      $this->widgetSchema['relationship'] = new sfWidgetFormChoice(array('multiple'=>true,'expanded'=>true,'choices' => myUser::getRelationship()));


      $this->widgetSchema['eye_color'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getEyeColor()));
      $this->widgetSchema['weight'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getWeight()));
      $this->widgetSchema['hair_lenght'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getHairLenght()));
      $this->widgetSchema['hair_color'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getHairColor()));
      $this->widgetSchema['looking_for'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getGender()));
      $this->widgetSchema['looking_for_role'] = new sfWidgetFormChoice(array('expanded'=>false,'choices' => myUser::getLookingForRole()));

      //$this->widgetSchema['i_can_receive'] = new sfWidgetFormChoice(array('multiple'=>true,'expanded'=>true,'choices' => myUser::getIcanRecive()));
      

      $this->validatorSchema['first_name'] = new sfValidatorString(array('required' => true),array('required'=>__('Поле обязательно.')));
      $this->validatorSchema['last_name'] = new sfValidatorString(array('required' => true),array('required'=>__('Поле обязательно.')));
      $this->validatorSchema['real_name'] = new sfValidatorString(array('required' => true),array('required'=>__('Поле обязательно.')));
      $this->validatorSchema['country'] = new sfValidatorString(array('required' => true),array('required'=>__('Поле обязательно.')));
      $this->validatorSchema['city'] = new sfValidatorString(array('required' => true),array('required'=>__('Поле обязательно.')));

      //$this->validatorSchema ['birthday'] = new sfValidatorDate();
     // $this->validatorSchema['mobile_phone'] = new sfValidatorString(array('required' => true),array('required'=>__('Поле обязательно.')));

      
      
    $this->validatorSchema->setPostValidator(
      new sfValidatorSchemaCompare('looking_for_age_from', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'looking_for_age_to',
        array('throw_global_error' => true),
        array('invalid' => 'The start age ("%left_field%") must be before the end age ("%right_field%")')
      )
    );


      $custom_decorator = new sfWidgetFormSchemaFormatterDefList($this->getWidgetSchema());
      $this->getWidgetSchema()->addFormFormatter('deflist', $custom_decorator);
      $this->getWidgetSchema()->setFormFormatterName('deflist');




  }
}

class sfWidgetFormSchemaFormatterDefList extends sfWidgetFormSchemaFormatter {
    protected
      $rowFormat                 = '<div class="row">%label%%field%%error%%help%%hidden_fields%</div>',
      $helpFormat                = '<span class="help">%help%</span>',
      $errorRowFormat            = '<div class="error">Errors:%errors%</div>',
      $errorListFormatInARow     = '<ul class="error_list">%errors%</ul>',
      $errorRowFormatInARow      = '<li>%error%</li>',
      $namedErrorRowFormatInARow = '<li>%name%: %error%</li>',
      $decoratorFormat           = '<dl id="formContainer">%content%</dl>';
}
