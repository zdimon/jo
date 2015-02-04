<?php


class setOnlineFilter extends sfFilter
{
  public function execute ($filterChain)
  {

    /// онлайн
    if($this->getContext()->getUser()->isAuthenticated())
    {
        $context = $this->getContext();
        $u = $this->getContext()->getUser()->getGuardUser();
        if($u)
        {
            $u->setTimer(time());
            $u->setIsOnline(true);
            $u->save();
        }

       
    }



    //

    $filterChain->execute();
  }
}
