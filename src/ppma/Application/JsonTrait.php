<?php


namespace ppma\Application;


trait JsonTrait
{

    /**
     * @param array $data
     * @param int $status
     * @param array $headers
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function json($data = array(), $status = 200, $headers = array())
    {
        return \ppma::app()->silex()->json($data, $status, $headers);
    }

}