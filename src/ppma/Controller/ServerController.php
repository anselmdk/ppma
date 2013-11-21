<?php

namespace ppma\Controller;

use ppma\Config;

class ServerController extends ControllerImpl
{

    /**
     * @var \ppma\Service\Response\Json\DispatchServiceImpl
     */
    protected $response;

    /**
     * @return array ['propertyName' => 'class name of service']
     */
    public function services()
    {
        return [
            array_merge(Config::get('services.response.json'), ['target' => 'response']),
        ];
    }

    /**
     * @return void
     */
    public function getVersion()
    {
        $this->response->send([
            'version' => Config::get('version')
        ]);
    }

}