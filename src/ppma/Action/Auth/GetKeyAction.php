<?php


namespace ppma\Action\Auth;


use ppma\Action\ActionImpl;
use ppma\Config;
use ppma\Service\Model\Exception\UserNotFoundException;
use ppma\Service\Model\Phormium\UserServiceImpl;

class GetKeyAction extends ActionImpl
{

    /**
     * @var string
     */
    private $password;

    /**
     * @var UserServiceImpl
     */
    protected $userService;

    /**
     * @var string
     */
    private $username;

    public function init($args = [])
    {
        parent::init($args);

        $this->password = $args['password'];
        $this->username = $args['username'];
    }


    /**
     * @return void
     */
    public function run()
    {
        try {
            // get user
            $model = $this->userService->getByUsername($this->username);

            // verify password
            if (password_verify($this->password, $model->password)) {
                $this->response->send([
                    'key' => $model->authkey
                ]);
            }
            else {
                $this->response->send(null, 400);
            }

        } catch (UserNotFoundException $e) {
            $this->response->send(null, 400);
        }
    }

    /**
     * @return array
     */
    public function services()
    {
        return array_merge(parent::services(), [
            array_merge(Config::get('services.model.user'), ['target' => 'userService']),
        ]);
    }

} 