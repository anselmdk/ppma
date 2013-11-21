<?php


namespace ppma\Action\Server;


use ppma\Action\ActionImpl;

class PingAction extends ActionImpl
{

    /**
     * @return void
     */
    public function run()
    {
        $this->response->send(['message' => 'ping']);
    }

} 