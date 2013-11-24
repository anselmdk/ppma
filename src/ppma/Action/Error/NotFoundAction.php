<?php


namespace ppma\Action\Error;


use ppma\Action\ActionImpl;
use ppma\Service\ResponseService;

class NotFoundAction extends ActionImpl
{

    /**
     * @return ResponseService
     */
    public function run()
    {
        return $this->response
            ->addData('code', 404)
            ->addData('message', 'not found')
            ->setStatusCode(404)
        ;
    }

}