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
     * @return \ppma\Service\Response\JsonService|\ppma\Service\ResponseService
     */
    public function run()
    {
        try {
            // get user
            $model = $this->userService->getByUsername($this->username);

            // verify password
            if (password_verify($this->password, $model->password)) {
                return $this->response->addData('key', $model->authkey);
            }

        } catch (UserNotFoundException $e) {
        } catch (\Exception $e) {
            return $this->response
                ->addData('code', 999)
                ->addData('message', $e->getMessage())
                ->setStatus(500)
            ;
        }

        return $this->response->setStatus(400);
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