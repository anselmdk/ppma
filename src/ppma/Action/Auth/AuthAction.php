<?php


namespace ppma\Action\Auth;


use ppma\Action\ActionImpl;
use ppma\Action\Auth\Exception\WrongPasswordException;
use ppma\Action\AuthTrait;
use ppma\Logger;
use ppma\Service\Model\Exception\UserNotFoundException;

class AuthAction extends ActionImpl
{

    const AUTHENTICATION = 1;

    /**
     * @return string
     * @throws \Exception
     */
    public function run()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        $slug     = $this->request->get('slug');
        $password = $this->request->get('password');


        // get user
        try {
            /* @var \ppma\Service\Model\User $service */
            $service = $this->app->service('user');

            // get user
            $model = $service->getBySlug($slug);

            /* @var \ppma\Service\Password $service */
            $service = $this->app->service('password');

            if (!$service->verify($password, $model->password)) {
                throw new WrongPasswordException();
            }

            return $this->response->send([
                'key' => $model->authkey
            ]);
        } catch (\Exception $e) {
            if ($e instanceof UserNotFoundException || $e instanceof WrongPasswordException) {
                return $this->response->send([
                    'code'    => AuthAction::AUTHENTICATION,
                    'message' => 'authentication failed'
                ], 400);
            }

            throw $e;
        }
    }
}
