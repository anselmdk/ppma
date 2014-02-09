<?php


namespace ppma\Action\Auth;


use Behat\Mink\Exception\Exception;
use ppma\Action\ActionImpl;
use ppma\Action\AuthTrait;
use ppma\Logger;
use ppma\Service\Model\Exception\UserNotFoundException;
use ppma\Service\Response\Impl\AccessDeniedImpl;
use ppma\Service\ResponseService;

class CreateNewKeyAction extends ActionImpl
{

    use AuthTrait;

    const FORBIDDEN = 101;

    /**
     * @return ResponseService
     */
    public function run()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        // get user
        try {
            /* @var \ppma\Service\Model\User $service */
            $service = $this->app->service('user-service');
            $slug    = $this->request->get('slug');

            // get user
            $model = $service->getBySlug($slug);

            // create new key
            $service->createNewAuthKey($model);

            return $this->response->send([
                'key' => $model->authkey
            ]);

        } catch (UserNotFoundException $e) {
            var_dump($e);
            die();
            error(403);
            return new AccessDeniedImpl();
        }
    }
}
