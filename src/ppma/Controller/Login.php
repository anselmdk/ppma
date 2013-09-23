<?php


namespace ppma\Controller;

use ppma\Controller;
use ppma\Entity\User;
use Symfony\Component\HttpFoundation\Request;


class Login extends Controller
{

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

        // hash and pad password
        $password = sha1($user->salt . str_pad($password, 32, $user->salt));

        // check password
        if ($password != $user->password)
        {
            $response['message'] = 'Your login details are invalid.';
            return $this->json($response);
        }

        // all fine
        $response['error']     = false;
        $response['forwardTo'] = \ppma::app()['url_generator']->generate('home');
        return $this->json($response);
    }

}