<?php

require_once(dirname(__FILE__).'/../lib/symfony/lib/autoload/sfCoreAutoload.class.php');

sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
   
    $this->enablePlugins('sfDoctrinePlugin');
	$this->enablePlugins('sfPHPCaptchaPlugin');
    $this->enablePlugins('sfDoctrineGuardPlugin');   
    $this->enablePlugins('mgI18nPlugin');
    $this->enablePlugins('sfCKEditorPlugin');
    $this->enablePlugins('sfImageTransformPlugin');
    $this->enablePlugins('sfAdminThemejRollerPlugin');
    $this->enablePlugins('sfFormExtraPlugin');
    $this->enablePlugins('sfJqueryReloadedPlugin');
    $this->enablePlugins('sfSwfObjectHelperPlugin');


     $this->enablePlugins('sfJQueryUIPlugin');
    $this->enablePlugins('sfPaymentPlugin');
    $this->enablePlugins('sfPaymentPayPalPlugin');
    $this->enablePlugins('sfCacheTaggingPlugin');
    $this->enablePlugins('sfTagedCachePlugin');
	$this->enablePlugins('sfThumbnailPlugin');

     $this->enablePlugins('sfWebBrowserPlugin');
    $this->enablePlugins('sfDateTimePlugin');
    sfConfig::set('sf_upload_dir','/var/www/ourfeeling14/work/uploads');
    sfConfig::set('sf_web_dir','/var/www/ourfeeling14/work');	 
	
	$this->enablePlugins('sfCaptchaGDPlugin');
	$this->enablePlugins('sfDoctrineForumPlugin');
	 
  }
}
