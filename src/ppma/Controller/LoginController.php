<?php


namespace ppma\Controller;


use PHPassLib\Hash\BCrypt;
use ppma\Config;
use ppma\Controller;
use ppma\Logger\LoggerImpl;
use ppma\Logger;
use ppma\Service\Database\Exception\RecordNotFoundException;
use ppma\Service\Database\Spot\UserServiceImpl;
use ppma\Service\Response\HtmlService;
use ppma\Service\Response\JsonServiceImpl;
use ppma\Service\ResponseService;
use ppma\Service\User\SessionServiceImpl;

class LoginController extends ControllerImpl
{

    /**
     * @var HtmlService
     */
    protected $html;

    /**
     * @var ResponseService
     */
    protected $json;

    /**
     * @var UserServiceImpl
     */
    protected $userEntity;

    /**
     * @var SessionServiceImpl
     */
    protected $user;

    public function before()
    {
        parent::before();
        redirect(Config::get('url.base') . Config::get('url.app'), 302, $this->user->isAuthenticated());
    }


    /**
     * @return void
     */
    public function get()
    {
        $this->html->render('login');
    }

    /**
     * @return void
     */
    public function post()
    {
        // prepare response
        $response = [
            'error'   => true,
            'message' => ''
        ];

        // get username and password
        $username = params('username');
        $password = params('password');

        // check if username and password set
        if (is_null($username) || is_null($password))
        {
            $response['message'] = 'Username and password cannot be blank.';
            $this->json->send($response);
            return;
        }

        // retrieve user
        $user = null;
        try {
            $user = $this->userEntity->getByUsername($username);
        } catch (RecordNotFoundException $e) {
            $response['message'] = 'Your login details are invalid.';
            $this->json->send($response);
            return;
        }

        // check password
        if (!BCrypt::verify(md5($password), $user->getPassword()))
        {
            $response['message'] = 'Your login details are invalid.';
            $this->json->send($response);
            return;
        }

        // sign user in
        $this->user->login($user);

        // all fine
        $response['error'] = false;
        $this->json->send($response);
    }

    /**
     * @return array
     */
    public function services()
    {
        return [
            array_merge(Config::get('services.response.html'), ['target' => 'html']),
            array_merge(Config::get('services.response.json'), ['target' => 'json']),
            array_merge(Config::get('services.database.user'), ['target' => 'userEntity']),
            array_merge(Config::get('services.user'), ['target' => 'user']),
        ];
    }

}