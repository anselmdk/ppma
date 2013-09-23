<?php


namespace ppma\Controller;

use ppma\Controller;
use ppma\Entity\User;
use Symfony\Component\HttpFoundation\Request;



class App extends Controller
{

    /**
     * @return string
     */
    public function home()
    {
        return $this->render('app');
    }


    /**
     * @return string
     */
    public function login()
    {
        return $this->render('login');
    }


    public function doLogin(Request $request)
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