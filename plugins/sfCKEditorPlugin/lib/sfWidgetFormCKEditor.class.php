<?php

class sfWidgetFormCKEditor extends sfWidgetFormTextarea {

  protected function configure($options = array(), $attributes = array())
  {
      if(isset($options['jsoptions']))
     {
        $this->addOption('jsoptions', $options['jsoptions']);    
      }
      parent::configure($options, $attributes);
  }
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    
    $editorPath = sfConfig::get('sf_rich_text_ck_js_file', '/ckeditor/ckeditor.js');
    $managerPath = '/ckeditor/ajexFileManager/ajex.js';




    
    sfContext::getInstance()->getResponse()->addJavascript($editorPath);
    sfContext::getInstance()->getResponse()->addJavascript($editorPath);
    
    $textarea = parent::render($name, $value , $attributes, $errors);
    
    $html = "<script type='text/javascript' >";
    $html  .= " CKEDITOR.replace('".$name."',{";
    
    $jsoptions = $this->getOption('jsoptions');
    if($jsoptions)
    {
      $sep = '';
      foreach($jsoptions as $k => $v)
      {
        $html .= $sep.$k." : ".$v."";
        $sep = ',';
      }
      
    }
    
    $html .="});";
    $html .= "</script>";
    
    return $textarea.$html;
  }
}