<?php


namespace ppma\Controller;


use PHPassLib\Hash\BCrypt;
use ppma\Application\JsonTrait;
use ppma\Application\SilexTrait;
use ppma\Application\UrlGeneratorTrait;
use ppma\Application\UserTrait;
use ppma\Application\ViewTrait;
use ppma\Controller;
use ppma\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class Login
{
    use JsonTrait, UserTrait, UrlGeneratorTrait, ViewTrait;

    /**
     * @return string
     */
    public function get()
    {
        return $this->render('login');
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function post(Request $request)
    {
        // prepare response
        $response = [
            'error'   => true,
            'message' => ''
        ];

        // get username and password
        $username = $request->get('username');
        $password = $request->get('password');

        // check if username and password set
        if (is_null($username) || is_null($password))
        {
            $response['message'] = 'Username and password cannot be blank.';
            return $this->json($response);
        }

        // get user
        $user = User::findByUsername($username);

        // check if user exist
        if (!($user instanceof User))
        {
            $response['message'] = 'Your login details are invalid.';
            return $this->json($response);
        }

        // check password
        if (!BCrypt::verify(md5($password), $user->password))
        {
            $response['message'] = 'Your login details are invalid.';
            return $this->json($response);
        }

        // create user for session
        $this->user()->setEntitiy($user, md5($password));

        // all fine
        $response['error']     = false;
        $response['forwardTo'] = $this->path('app');
        return $this->json($response);
    }

}