<?php


namespace ppma\Action\Error;


use ppma\Action\ActionImpl;
use ppma\Logger;
use ppma\Service\ResponseService;

class NotFoundAction extends ActionImpl
{

    /**
     * @return ResponseService
     */
    public function run()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        return $this->response
            ->addData('code', 404)
            ->addData('message', 'not found')
            ->setStatusCode(404)
        ;
    }

}