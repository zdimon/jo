<?php

/**
 * Notify form.
 *
 * @package    levandos
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class NotifyForm extends BaseNotifyForm
{
  public function configure()
  {

      $this->embedI18n(myUser::getCultures());
      
  }
}
