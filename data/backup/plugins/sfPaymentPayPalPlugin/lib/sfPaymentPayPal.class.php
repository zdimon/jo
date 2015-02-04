<?php

/**
 * sfPaymentPayPal Class
 *
 * This provides support for PayPal to sfPaymentPlugin. It has 
 * been inspired from Md Emran Hasan work (http://www.phpfour.com).
 *
 * @package   sfPaymentPayPal
 * @category  Library
 * @author    Md Emran Hasan <phpfour@gmail.com>
 * @author    Johnny Lattouf <johnny.lattouf@letscod.com>
 * @author    Antoine Leclercq <antoine.leclercq@letscod.com>
 * @link      http://www.phpfour.com
 * @link      http://wiki.github.com/letscod/sfPaymentPlugin
 */

class sfPaymentPayPal extends sfPaymentGatewayInterface {
	
	public function __construct() {
		parent::__construct();
		
		// translation table
		$this->addFieldTranslation('Vendor',          'business');
		$this->addFieldTranslation('Currency',        'currency_code');
    $this->addFieldTranslation('Amount',          'amount');
    $this->addFieldTranslation('ProductName',     'item_name');
    $this->addFieldTranslation('ProductPrice',    'item_price');
    $this->addFieldTranslation('ItemNumber',    'item_number');
    $this->addFieldTranslation('Custom',    'custom');
    // specify the url where paypal will send the user on success/failure
    $this->addFieldTranslation('Return',          'return');
    // specify the url where paypal will send the user on cancel
    $this->addFieldTranslation('CancelReturn',    'cancel_return');
    // specify the url where paypal will send the IPN
    $this->addFieldTranslation('Notify',          'notify_url');
    $this->addFieldTranslation('Rm',              'rm');
    $this->addFieldTranslation('Cmd',             'cmd');



    // default values of the class
		$this->gatewayUrl = 'https://www.paypal.com/cgi-bin/webscr';
		$this->ipnLogFile = 'paypal.ipn_results.log';

		// populate $fields array with a few default
		$this->setRm('2');           // return method = POST
		$this->setCmd('_xclick');
		
		// set from config values
		$this->setReturn(url_for(sfConfig::get('app_sf_payment_paypal_plugin_return','sfPaymentPayPal/success'),true));
		$this->setCancelReturn(url_for(sfConfig::get('app_sf_payment_paypal_plugin_cancel_return','sfPaymentPayPal/failure'),true));
		$this->setNotify(url_for(sfConfig::get('app_sf_payment_paypal_plugin_notify','sfPaymentPayPal/ipn'),true));

		if(sfConfig::get('app_sf_payment_paypal_plugin_business'))
		  $this->setVendor(sfConfig::get('app_sf_payment_paypal_plugin_business'));
		else
		  throw new sfException('No business paypal acccount referenced in app.yml.<br />Please check the README file.');
	}
	
	/**
	 * Enables test mode
	 *
	 * @param none
	 * @return none
	 */
	public function enableTestMode()
  {
  	$this->testMode = true;
    $this->gatewayUrl = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
    
    $test = sfConfig::get('app_sf_payment_paypal_plugin_test');
    
    if(isset($test['business']))
      $this->setVendor($test['business']);
    else
      throw new sfException('No test business paypal acccount referenced in app.yml.<br />Please check the README file.');
  }
    
 	/**
	 * Validate the IPN notification
	 *
	 * @param none
	 * @return boolean
	 */
	public function validateIpn($parameters = array())
	{
		// retrieve the parameters
		$this->ipnData = $parameters;
		$parameters["cmd"] = "_notify-validate"; 
		$browser = new sfWebBrowser(array("Content-type: application/x-www-form-urlencoded\r\n","Connection: close\r\n\r\n"));
		$browser->post($this->gatewayUrl, $parameters);

              
		$this->ipnResponse= $browser->getResponseText();



     if($browser->getResponseText() === "VERIFIED")
     {
      // if($dd == 1)
    
      // Valid IPN transaction.

    	/*
        $pf = sfGuardUserPeer::retrieveByPK($parameters["item_number"]);
        //$pf->setAccount($pf->getAccount()+$parameters["custom"]);
        $pf->setAccount($pf->getAccount()+1000);
        $pf->save();
        */

    	$id_user=$parameters["item_number"];
        $user = Doctrine::getTable('sfGuardUser')->find($id_user);
        $basket = $parameters["custom"];
        $type = $parameters["custom_type"];
        $summa = $parameters["payment_gross"];

        	    $par = $parameters;
                    $str = '';
                    foreach($par as $k=>$v)
                    {
                        $str .= $k.'=>'.$v.';';
                    }



		 /*
		  * ********************************************************
		  * ********************************************************
		  */    	
    	

        ////Оплаты подарков

        if(strlen($basket)>0 and $type='gift_pay')
        {
            $ar = explode('|', $basket);
            foreach ($ar as $k=>$v)
            {
                $order = Doctrine::getTable('GiftOrder')->find($v);
                if($order)
                {
                    $order->setStatusId(2);
                    $order->save();

                    // пишем в лог расходов
                    $woman = $order->getToUser();
                    $pa = new Payment ( );
                    $pa->setSumma($summa);
                    $pa->setServiceId(9);
                    $pa->setUserId($id_user);
                    $pa->setWomanId($woman->getId());
                    $pa->setPartnerId($woman->getPartnerId());
                    $pa->setDescription($parameters["item_name"]);
                    $pa->save ();

                }
            }
        
        }

        if($type='account_pay')
        {
                   if($t = $this->getType($summa)){
                        // пишем платеж
                        $user->setAccount($user->getAccount()+$t->getCredit());
                        $user->save();
                        $b = new Billing();
                        $b->setTitle($parameters["item_name"]);
                        $b->setTypeId($t->getId());
                        $b->setUserId($id_user);
                        $b->setSumma($t->getSumma());
                        $b->setBalance($user->getAccount());
                        $b->setCredit($t->getCredit());
                        $b->save();
                   }
        }

    	

		
			

      $this->logResults(true);
      return true;
    }
    else
    {
    	// Invalid IPN transaction.  Check the log for details.
      $this->lastError = "IPN Validation Failed . ".$this->gatewayUrl;
      $this->logResults(false);
      return false;
    }
	}
	
	/**
	 * Check if the payment status is completed after ipn validation 
	 *
	 * @return boolean
	 */
	public function isCompleted() {
		if($this->ipnData['payment_status'] == 'Completed')
		  return true;
		else
		  return false;
	}


      protected function getType($summa)
  {
      $p = Doctrine::getTable('BillingType')
      ->createQuery('a')
              ->where('a.summa=?',$summa)
              ->fetchOne();
      if($p)
      {
          return $p;
      }
      else
      {
          return false;
      }
  }

}