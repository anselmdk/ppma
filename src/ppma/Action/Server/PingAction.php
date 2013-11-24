<?php


namespace ppma\Action\Server;


use Nocarrier\Hal;
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

        $hal = new Hal('/', [
            'message' => 'pong',
        ]);

        return $this->response
            ->setBody($hal->asJson())
            ->setStatusCode(200)
            ->addHeader('Content-Type', 'application/hal+json')
        ;
    }

} 