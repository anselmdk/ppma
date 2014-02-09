<?php


namespace ppma;


use Hahns\Hahns;
use Hahns\Request;
use Hahns\Response\Json;

interface Action
{

    /**
     * @return void
     */
    public function after();

    /**
     * @return void
     */
    public function before();

    /**
     * @return mixed
     */
    public function run();

    /**
     * @param Request $request
     * @return void
     */
    public function setRequest(Request $request);

    /**
     * @param Hahns $app
     * @return void
     */
    public function setApplication(Hahns $app);

    /**
     * @param Json $response
     * @return void
     */
    public function setResponse(Json $response);
}
