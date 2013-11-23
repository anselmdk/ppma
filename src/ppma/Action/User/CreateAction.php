<?php


namespace ppma\Action\User;


use Nocarrier\Hal;
use ppma\Action\ActionImpl;
use ppma\Config;
use ppma\Service\Database\Exception\EmailIsRequiredException;
use ppma\Service\Database\Exception\PasswordIsRequiredException;
use ppma\Service\Database\Exception\PasswordNeedsToBeALengthOf64Exception;
use ppma\Service\Database\Exception\UsernameAlreadyExistsException;
use ppma\Service\Database\Exception\UsernameIsRequiredException;
use ppma\Service\Database\UserService;

class CreateAction extends ActionImpl
{

    const USERNAME_IS_REQUIRED    = 1;
    const USERNAME_ALREADY_EXISTS = 2;
    const EMAIL_IS_REQUIRED       = 3;
    const PASSWORD_IS_REQUIRED    = 4;
    const PASSWORD_IS_INVALID     = 5;

    /**
     * @var HttpFoundationServiceImpl
     */
    protected $request;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @return array
     */
    public function services()
    {
        return array_merge(parent::services(), [
            array_merge(Config::get('services.database.user'), ['target' => 'userService']),
            array_merge(Config::get('services.request'),       ['target' => 'request'])
        ]);
    }

    /**
     * @return void
     */
    public function run()
    {
        // create hal object
        $hal    = new Hal('/users');
        $header = ['Content-Type' => 'application/hal+json'];
        $status = 201;

        try
        {
            // get attributes
            $username = $this->request->post('username');
            $email    = $this->request->post('email');
            $password = $this->request->post('password');

            // create user
            $model = $this->userService->create($username, $email, $password);

            // add apikey to hal
            $hal->setData([
                'apikey' => $model->apikey
            ]);

            // get uri of user
            $uri = sprintf('/users/%s', $model->slug);

            // add link to user profile
            $hal->addLink('user', $uri);

            // add created resource to header
            $header['Location'] = $uri;

        // no username
        } catch (UsernameIsRequiredException $e) {
            $status = 400;
            $hal->setData([
                'code'    => self::USERNAME_IS_REQUIRED,
                'message' => '`username` is required'
            ]);

        } catch (UsernameAlreadyExistsException $e) {
            $status = 400;
            $hal->setData([
                'code'    => self::USERNAME_ALREADY_EXISTS,
                'message' => '`username` already exists in database'
            ]);

        // no email
        } catch (EmailIsRequiredException $e) {
            $status = 400;
            $hal->setData([
                'code'    => self::EMAIL_IS_REQUIRED,
                'message' => '`email` is required'
            ]);

        // no password
        } catch (PasswordIsRequiredException $e) {
            $status = 400;
            $hal->setData([
                'code'    => self::PASSWORD_IS_REQUIRED,
                'message' => '`password` is required'
            ]);

        // no password
        } catch (PasswordNeedsToBeALengthOf64Exception $e) {
            $status = 400;
            $hal->setData([
                'code'    => self::PASSWORD_IS_INVALID,
                'message' => '`password` is not a sha256 hash'
            ]);

        // unknown error
        } catch (\Exception $e) {
            $status = 400;
            $hal->setData([
                'code'    => 999,
                'message' => $e->getMessage()
            ]);
        }

        $this->response->send($hal->asJson(), $status, $header);
    }

} 