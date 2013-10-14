<?php

namespace ppma\Controller;

use ppma\Application\JsonTrait;
use ppma\Controller;
use ppma\Entity\Entry;
use Silex\Application;
use Spot\Query;
use Symfony\Component\HttpFoundation\Request;

class Entries
{
    use JsonTrait;


    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function all()
    {
        $models = Entry::findAll()->order(['id' => 'desc']);
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

        return $this->json($data);
    }


    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function recent()
    {
        $models = Entry::findAll()->order(['id' => 'desc'])->limit(1);
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

        return $this->json($data);
    }

}