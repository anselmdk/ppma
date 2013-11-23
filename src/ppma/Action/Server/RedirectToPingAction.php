<?php


namespace ppma\Action\Server;


use ppma\Action\ActionImpl;

class RedirectToPingAction extends ActionImpl
{

    /**
     * @return void
     */
    public function run()
    {
        $header = ['Location' => '/ping'];
        $this->response->send(null, 303, $header);
    }

} 