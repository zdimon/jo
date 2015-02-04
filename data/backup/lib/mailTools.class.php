<?php

class mailTools
{

    	static function send($send_to, $subject, $message)
	{

            //$message = icon;
//            $send_time = date("d.m.Y в H:i:s");
//            $headers = "MIME-Version: 1.0\r\n";
//            $headers .= "Content-type: text/html; charset=utf-8\r\n";
//            $headers .= "From: <admin@urokov.net.ua>\r\n";
//            $headers .= "Reply-To: <admin@urokov.net.ua>\r\n";
//            $result = mail($send_to, $subject, $message, $headers);
             $letter = sfContext::getInstance()->getMailer()->compose(sfConfig::get('app_email_reply'), $send_to, $subject, $message)->setContentType('text/html');
             sfContext::getInstance()->getMailer()->send($letter);
            // echo $message;
            // die;

	}


        	static function send2($send_to, $subject, $message, $from='admin@urokov.net.ua')
	{

            $message = icon;
            $send_time = date("d.m.Y в H:i:s");
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= "From: <admin@urokov.net.ua>\r\n";
            $headers .= "Reply-To: <admin@urokov.net.ua>\r\n";
            $result = mail($send_to, $subject, $message, $headers);


	}






}
