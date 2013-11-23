<?php


namespace ppma\Action\Server;


use Nocarrier\Hal;
use ppma\Action\ActionImpl;

class PingAction extends ActionImpl
{

    /**
     * @return \ppma\Service\ResponseService
     */
    public function run()
    {
        $hal = new Hal('/', [
            'message' => 'pong',
        ]);

        return $this->response
            ->setData(json_decode($hal->asJson()))
            ->setStatusCode(200)
            ->addHeader('Content-Type', 'application/hal+json')
        ;
        //$this->response->send($hal->asJson(), 200, ['Content-Type' => 'application/hal+json']);
    }

} 