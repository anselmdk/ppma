<?php


namespace ppma\Controller;


use PHPassLib\Hash\BCrypt;
use ppma\Config;
use ppma\Controller;
use ppma\Logger;
use ppma\Model\UserModel;
use ppma\Service\Database\UserService;
use ppma\Service\Response\JsonService;

class UserController extends ControllerImpl
{

    /**
     * @var JsonService
     */
    protected $response;

    /**
     * @var UserService
     */
    protected $userService;


    /**
     * @return array
     */
    public function services()
    {
        return [
            array_merge(Config::get('services.response.json'), ['target' => 'response']),
            array_merge(Config::get('services.database.user'), ['target' => 'userService'])
        ];
    }

    public function create()
    {
        try
        {
            // get attributes
            $username = $_POST['username'];
            $email    = $_POST['email'];
            $password = $_POST['password'];

            // create user
            $model = $this->userService->create($username, $email, $password);

            // send response
            $header = ['Location' => sprintf('/users/%s', $model->slug)];
            $this->response->send([], 201, $header);

        // unknown error
        } catch (\Exception $e) {
            $this->response->send([
                'code'    => 999,
                'message' => $e->getMessage()
            ], 500);
        }

    }

}