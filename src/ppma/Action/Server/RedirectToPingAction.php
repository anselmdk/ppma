<?php


namespace ppma\Action\Server;


use ppma\Action\ActionImpl;
use ppma\Logger;

class RedirectToPingAction extends ActionImpl
{

    /**
     * @return \ppma\Service\ResponseService
     */
    public function run()
    {
        Logger::debug('execute run()', __CLASS__);

        return $this->response
            ->setStatusCode(301)
            ->addHeader('Location', '/ping')
        ;
    }

} 