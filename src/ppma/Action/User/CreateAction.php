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
        try
        {
            // get attributes
            $username = $this->request->post('username');
            $email    = $this->request->post('email');
            $password = $this->request->post('password');

            // create user
            $model = $this->userService->create($username, $email, $password);

            // create hal
            $hal = new Hal('/users', [
                'apikey' => $model->apikey
            ]);

            // get uri of user
            $uri = sprintf('/users/%s', $model->slug);

            // add link to user profile
            $hal->addLink('user', $uri);

            // send response
            $header = ['Location' => $uri];
            $this->response->send($hal->asJson(), 201, $header);

        // no username
        } catch (UsernameIsRequiredException $e) {
            $this->response->send([
                'code'    => self::USERNAME_IS_REQUIRED,
                'message' => '`username` is required'
            ], 400);

        } catch (UsernameAlreadyExistsException $e) {
            $this->response->send([
                'code'    => self::USERNAME_ALREADY_EXISTS,
                'message' => '`username` already exists in database'
            ], 400);

        // no email
        } catch (EmailIsRequiredException $e) {
            $this->response->send([
                'code'    => self::EMAIL_IS_REQUIRED,
                'message' => '`email` is required'
            ], 400);

        // no password
        } catch (PasswordIsRequiredException $e) {
            $this->response->send([
                'code'    => self::PASSWORD_IS_REQUIRED,
                'message' => '`password` is required'
            ], 400);

        // no password
        } catch (PasswordNeedsToBeALengthOf64Exception $e) {
            $this->response->send([
                'code'    => self::PASSWORD_IS_INVALID,
                'message' => '`password` is not a sha256 hash'
            ], 400);

        // unknown error
        } catch (\Exception $e) {
            $this->response->send([
                'code'    => 999,
                'message' => $e->getMessage()
            ], 500);
        }
    }

} 