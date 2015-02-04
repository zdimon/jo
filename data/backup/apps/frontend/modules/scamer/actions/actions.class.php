<?php

/**
 * scamer actions.
 *
 * @package    levandos
 * @subpackage scamer
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class scamerActions extends commonActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeIndex($request) {


        $this->checkAuthorization();

        $this->form = new frontendContactForm( );

        if ($request->isMethod ( 'post' ))

        {

            $this->form->bind ( $request->getParameter ( 'contact' ) );
            if ($this->form->isValid ()) {

                $data = $request->getParameter ( 'contact' );



                mailTools::send ( 'moderator@our-feeling.com','complaine ', 'From '.$this->getUser()->getGuardUser()->getId().'<br />To '.$data['id'].'<br />'.nl2br ( $data['content'] ));

                $this->getUser ()->setFlash ( 'message', __('You complaine has been saved!') );
                $this->redirect ( 'scamer/index' );

            }

        }


       $this->getScamer($request);
        $this->insertArrays();
    }

    public function getScamer($request)
    {
        $q = Doctrine::getTable('Profile')
            ->createQuery('a')
            ->where('a.scamer=? ',array(true));
        $this->pager = new sfDoctrinePager('Profile',20);
        $this->pager->setQuery($q);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }
}
