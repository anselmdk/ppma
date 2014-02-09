<?php


namespace ppma\Action\Server;


use ppma\Action\ActionImpl;
use ppma\Logger;

class RedirectToPingAction extends ActionImpl
{

    public function run()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        $this->response->redirect('/ping');
    }
}
