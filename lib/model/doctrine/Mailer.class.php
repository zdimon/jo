<?php

/**
 * Mailer
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    levandos
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Mailer extends BaseMailer
{

    public function send()
    {
        $user = $this->getUser();

        $l = MailerTable::getNotify($this->getLetterId(),$user->getCulture());


        $title = $l->Translation[$user->getCulture()]->title;
        $content = $l->Translation[$user->getCulture()]->content;

       $username = $user->getProfile()->getFirstName().' '.$user->getProfile()->getLastName();

        $title = str_replace('%username%',$username,$title);
        $content = str_replace('%username%',$username,$content);

        mailTools::send($user->getEmail(),$title,$content);

    }

    public function setIsSent($v)
    {
        $this->_set('is_sent', $v);

        if($v==true)
        {
        $this->setDateSent(date('Y-m-d'));
        $this->save();

        $u = $this->getUser();

            if(strlen($this->getEmail())>0)
            {
                mailTools::send($this->getEmail(), $this->getTitle(), $this->getContent());
            }
        }

    }



}