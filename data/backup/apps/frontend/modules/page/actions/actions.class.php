<?php

/**
 * page actions.
 *
 * @package    levandos
 * @subpackage page
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pageActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
       $this->page = Doctrine::getTable('Page')
      ->createQuery('a')
      ->leftJoin('a.Translation t')
      ->where('a.alias=?',$request->getParameter('alias'))
      ->fetchOne();
       $this->forward404Unless($this->page);

       ////Устанавливаем заголовки
		    $this->getResponse()->addMeta('description',  $this->page->getItitle());
		    $this->getResponse()->addMeta('keywords', $this->page->getItitle());
		    $this->getResponse()->addMeta('title',  $this->page->getItitle());
	   ////
	   
	   if($this->page->getId()==17 or $this->page->getId()==26)
	   $this->form = new frontendApartmentForm();
	   
	   if ($request->isMethod ( 'post' )) 

		{
			
			$this->form->bind ( $request->getParameter ( 'contact' ) );
			if ($this->form->isValid ()) {

                            $data = $request->getParameter ( 'contact' );
                            
			
				
				mailTools::send ( sfConfig::get('app_email_admin'),'Письмо cо страницы услуг', nl2br ( $data['content'] ) );			  	
                $this->getUser ()->setFlash ( 'message', __('Сообщение отправлено') );
				$this->redirect ( 'page/index?alias='.$request->getParameter('alias') );
			
			}
		
		}
		
       
  }
}
