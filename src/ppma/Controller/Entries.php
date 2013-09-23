<?php

namespace ppma\Controller;

use Silex\Application;
use Spot\Query;
use Symfony\Component\HttpFoundation\Request;

class Entries
{

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function all()
    {
        /* @var Query $query */
        $query  = \ppma::instance()->getDatabase()->all('\ppma\Entity\Entry');
        $models = $query->order(['id' => 'desc']);
        $data   = [];

        // prepare response
        foreach ($models as $model)
        {
            $data[] = [
                'id'       => $model->id,
                'name'     => $model->url,
                'comment'  => $model->comment,
                'username' => $model->username
            ];
        }

        return \ppma::app()->json($data);
    }





    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function recent()
    {
        /* @var Query $query */
        $query = \ppma::instance()->getDatabase()->all('\ppma\Entity\Entry');
        $models = $query->order(['id' => 'desc'])->limit(1);
        $data   = [];

        // prepare response
        foreach ($models as $model)
        {
            $data[] = [
                'id'       => $model->id,
                'name'     => $model->url,
                'comment'  => $model->comment,
                'username' => $model->username
            ];
        }

        return \ppma::app()->json($data);
    }

}