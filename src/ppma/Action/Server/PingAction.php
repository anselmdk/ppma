<?php


namespace ppma\Action\Server;


use Nocarrier\Hal;
use ppma\Action\ActionImpl;

class PingAction extends ActionImpl
{

    /**
     * @return void
     */
    public function run()
    {
        $hal = new Hal('/', [
            'message' => 'pong'
        ]);

        $this->response->send($hal->asJson());
    }

} 