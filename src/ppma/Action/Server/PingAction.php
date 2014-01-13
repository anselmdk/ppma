<?php


namespace ppma\Action\Server;


use ppma\Action\ActionImpl;
use ppma\Logger;

class PingAction extends ActionImpl
{

    /**
     * @return \ppma\Service\ResponseService
     */
    public function run()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        return $this->response->setData([
            'message' => 'pong',
        ])->setStatusCode(200);
    }
}
