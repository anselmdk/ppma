<?php


namespace ppma\Action\Signature;


use ppma\Action\ActionImpl;
use ppma\Exception\Response\NotFoundException;
use ppma\Service\Model\Exception\UserNotFoundException;

class GetAction extends ActionImpl
{

    public function run()
    {
        /* @var \ppma\Service\Model\User $service */
        $slug    = $this->request->get('slug');
        $service = $this->app->service('user');

        try {
            $model = $service->getBySlug($slug);

        } catch (UserNotFoundException $e) {
            throw new NotFoundException();
        }
    }

}
