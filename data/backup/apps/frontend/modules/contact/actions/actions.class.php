<?php

/**
 * faq actions.
 *
 * @package    levandos
 * @subpackage faq
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contactActions extends commonActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $this->autoenter();
      $this->checkAuthorization();
      $q = Doctrine::getTable('Contact')
          ->createQuery('a')
          ->where('a.pub=?',array(true));

      $this->pager = new sfDoctrinePager('Contact',4);
      $this->pager->setQuery($q);
      $this->pager->setPage($request->getParameter('page', 1));
      $this->pager->init();

    $this->form = new fcontactForm();

      if ($request->isMethod ( 'post' ))
		{
			$this->form->bind ( $request->getParameter ( 'contact' ), $request->getFiles('contact') );
			if ($this->form->isValid ()) {

                          $f = $this->form->save();
                          $this->getUser ()->setFlash ( 'message', __('Thank you your message was sent.') );
                          $this->redirect ( 'contact/index' );

			}

		}



  }
}
