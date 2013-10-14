<?php


namespace ppma\Controller;


use PHPassLib\Hash\BCrypt;
use ppma\Application\JsonTrait;
use ppma\Application\UrlGeneratorTrait;
use ppma\Application\UserTrait;
use ppma\Controller;
use ppma\Entity\User;
use ppma\Service\Database\Spot\UserServiceImpl;
use ppma\Service\View\PhpServiceImpl;
use Symfony\Component\HttpFoundation\Request;

class Login extends ControllerImpl
{
    use JsonTrait, UserTrait, UrlGeneratorTrait;

    /**
     * @var UserServiceImpl
     */
    protected $userService;

    /**
     * @var PhpServiceImpl
     */
    protected $viewService;

    /**
     * @return array
     */
    public function services()
    {
        return [
            [
                'name' => 'userService',
                'id'   => 'ppma\Service\Database\Spot\UserServiceImpl',
            ],
            [
                'name' => 'viewService',
                'id'   => 'ppma\Service\View\PhpServiceImpl',
            ],
        ];
    }

    /**
     * @return string
     */
    public function get()
    {
        return $this->viewService->render('login');
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
        $user = $this->userService->getByUsername($username);

        // check if user exist
        if (!($user instanceof User))
        {
            $response['message'] = 'Your login details are invalid.';
            return $this->json($response);
        }

        // check password
        if (!BCrypt::verify(md5($password), $user->getPassword()))
        {
            $response['message'] = 'Your login details are invalid.';
            return $this->json($response);
        }

        // create user for session
        $this->user()->setEntitiy($user, md5($password));

        // all fine
        $response['error']     = false;
        $response['forwardTo'] = $this->path('app');
        $response['baseUrl']   = $request->getBaseUrl();
        return $this->json($response);
    }

}