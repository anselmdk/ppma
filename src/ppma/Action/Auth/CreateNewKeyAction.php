<?php


namespace ppma\Action\Auth;


use ppma\Action\ActionImpl;
use ppma\Action\AuthTrait;
use ppma\Config;
use ppma\Logger;
use ppma\Service\Model\Exception\UserNotFoundException;
use ppma\Service\Model\UserService;
use ppma\Service\RequestService;
use ppma\Service\Response\Impl\AccessDeniedImpl;
use ppma\Service\ResponseService;

class CreateNewKeyAction extends ActionImpl
{

    use AuthTrait;


    const FORBIDDEN     = 101;


    /**
     * @var string
     */
    protected $authkey;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var RequestService
     */
    protected $request;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @param array $args
     */
    public function init($args = [])
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        $this->slug     = $args['slug'];
        $this->authkey  = $this->request->header('X-Authkey');
    }

    /**
     * @return array
     */
    public function services()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        return array_merge(parent::services(), [
            array_merge(Config::get('services.request'),    ['target' => 'request']),
            array_merge(Config::get('services.model.user'), ['target' => 'userService']),
        ]);
    }


    /**
     * @return ResponseService
     */
    public function run()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        // get user
        try {
            // get user
            $model = $this->userService->getBySlug($this->slug);

            // check access
            $this->checkAccess($model, $this->request);

            // create new key
            $this->userService->createNewAuthKey($model);

            return $this->response->setData([
                'key' => $model->authkey
            ]);

        } catch (UserNotFoundException $e) {
            error(403);
            return new AccessDeniedImpl();
        }
    }

} 