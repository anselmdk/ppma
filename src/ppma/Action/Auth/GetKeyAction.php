<?php


namespace ppma\Action\Auth;


use ppma\Action\ActionImpl;
use ppma\Config;
use ppma\Logger;
use ppma\Service\Model\Exception\UserNotFoundException;
use ppma\Service\Model\UserService;

class GetKeyAction extends ActionImpl
{

    const AUTHENTICATION_FAILED = 1;


    /**
     * @var string
     */
    private $password;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var string
     */
    private $slug;

    /**
     * @param array $args
     */
    public function init($args = [])
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        parent::init($args);

        $this->password = $args['password'];
        $this->slug     = $args['slug'];
    }

    /**
     * @return \ppma\Service\Response\JsonService|\ppma\Service\ResponseService
     */
    public function run()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        try {
            // get user
            $model = $this->userService->getBySlug($this->slug);

            // verify password
            if (password_verify($this->password, $model->password)) {
                return $this->response->addData('key', $model->authkey);
            }

        } catch (UserNotFoundException $e) {
        }

        return $this->response
            ->addData('code', self::AUTHENTICATION_FAILED)
            ->addData('message', 'authentication failed')
            ->setStatusCode(400);
    }

    /**
     * @return array
     */
    public function services()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        return array_merge(parent::services(), [
            array_merge(Config::get('services.model.user'), ['target' => 'userService']),
        ]);
    }
}
