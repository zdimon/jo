<?php

/**
 * Message form.
 *
 * @package    piramida
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class frontendMessageForm extends BaseMessageForm
{
  public function configure()
  {

      		unset(
                        $this['title'],
                        $this['type_message'],
			$this['created_at'],
                        $this['from_username'],
                        $this['to_username'],
			$this['del_from'],
			$this['del_to'],
			$this['is_read'],
			$this['translate'],
              $this['popup'],
			$this['is_reply'],
			$this['from_partner_id'],
			$this['to_partner_id'],
			$this['pub'],
			$this['updated_at']

		);
                $this->widgetSchema['to_id'] =  new sfWidgetFormInputHidden();
                $this->widgetSchema['from_id'] =  new sfWidgetFormInputHidden();
                $this->widgetSchema['reply_id'] =  new sfWidgetFormInputHidden();

      $this->widgetSchema['image'] =  new sfWidgetFormInputFile(array(),array('style'=>'float: right'));
      $this->validatorSchema ['image'] = new sfValidatorFile ( array ('required' => false,
              'path' => sfConfig::get ( 'sf_web_dir' ) . '/uploads/message/original',
              'mime_types' => 'web_images', 'max_size' => 4000000) ,
          array ('invalid' => 'Неверный формат файла.',
              'required' => 'Выберите изображение.',
              'max_size' => 'Максимальный размер файла изображения 4 мегабайта',
              'mime_types' => 'Изображение должно быть изображением.' )
      );

                //$this->widgetSchema['type_id'] =  new sfWidgetFormInput();

                $this->widgetSchema['content'] = new sfWidgetFormCKEditor (array('jsoptions'=>array('filebrowserBrowseUrl'=>"'/ckfinder/ckfinder.html'",
  	                                                                             'filebrowserUploadUrl' => "'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'",
                                                                                     'toolbar ' => sfConfig::get('app_tool_bar_message'))),array('style'=>'width: 500px') );


     //$this->widgetSchema['content'] = new sfWidgetFormTextarea(array(),array('style'=>'width: 700px; height: 200px'));

      $this->widgetSchema->setLabels(array(
                  'content'	=> ' ',
                  'image'	=> __('You can add image to the message')
		));

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
