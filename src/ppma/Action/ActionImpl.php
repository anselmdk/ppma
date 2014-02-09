<?php


namespace ppma\Action;


use Hahns\Hahns;
use Hahns\Request;
use Hahns\Response\Json;
use ppma\Action;
use ppma\Logger;
use ppma\Service;

abstract class ActionImpl implements Action
{

    /**
     * @var Hahns
     */
    protected $app;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Json
     */
    protected $response;

    /**
     * @return void
     */
    public function after()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
    }

    /**
     * @return void
     */
    public function before()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
    }

    /**
     * @param Hahns $app
     * @return void
     */
    public function setApplication(Hahns $app)
    {
        $this->app = $app;
    }


    /**
     * @param Request $request
     * @return void
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Json $response
     * @return void
     */
    public function setResponse(Json $response)
    {
        $this->response = $response;
    }
}
