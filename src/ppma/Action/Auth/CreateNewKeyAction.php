<?php


namespace ppma\Action\Auth;


use ppma\Action\ActionImpl;
use ppma\Action\AuthTrait;
use ppma\Exception\Response\ForbiddenException;
use ppma\Logger;
use ppma\Service\Model\Exception\UserNotFoundException;

class CreateNewKeyAction extends ActionImpl
{

    use AuthTrait;

    const FORBIDDEN = 101;

    /**
     * @return string
     * @throws \ppma\Exception\Response\ForbiddenException
     */
    public function run()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        // get user
        try {
            /* @var \ppma\Service\Model\User $service */
            $service = $this->app->service('user');
            $slug    = $this->request->get('slug');

            // get user
            $model = $service->getBySlug($slug);

            // check access
            $this->checkAccess($model, $this->request);

            // create new key
            $service->createNewAuthKey($model);

            return $this->response->send([
                'key' => $model->authkey
            ]);

        } catch (UserNotFoundException $e) {
            throw new ForbiddenException(CreateNewKeyAction::FORBIDDEN, CreateNewKeyAction::FORBIDDEN);
        } catch (ForbiddenException $e) {
            throw new ForbiddenException(CreateNewKeyAction::FORBIDDEN, CreateNewKeyAction::FORBIDDEN);
        }
    }
}
