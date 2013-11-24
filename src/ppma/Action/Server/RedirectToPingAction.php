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
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        return $this->response
            ->setStatusCode(301)
            ->addHeader('Location', '/ping')
        ;
    }

} 