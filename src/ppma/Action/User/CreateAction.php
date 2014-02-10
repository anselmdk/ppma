<?php


namespace ppma\Action\User;


use ppma\Action\ActionImpl;
use ppma\Service\Model\Exception\EmailIsRequiredException;
use ppma\Service\Model\Exception\PasswordIsRequiredException;
use ppma\Service\Model\Exception\PasswordNeedsToBeALengthOf64Exception;
use ppma\Service\Model\Exception\UsernameAlreadyExistsException;
use ppma\Service\Model\Exception\UsernameIsRequiredException;

class CreateAction extends ActionImpl
{

    const USERNAME_IS_REQUIRED    = 1;
    const USERNAME_ALREADY_EXISTS = 2;
    const EMAIL_IS_REQUIRED       = 3;
    const PASSWORD_IS_REQUIRED    = 4;
    const PASSWORD_IS_NOT_HASHED  = 5;

    public function run()
    {
        $username = $this->request->post('username');
        $email    = $this->request->post('email');
        $password = $this->request->post('password');

        try {
            /* @var \ppma\Service\Model\User $service */
            $service = $this->app->service('user');

            // create model
            $model = new \ppma\Model\User();
            $model->username = $username;
            $model->email    = $email;
            $model->password = $password;

            // try to save model
            $service->create($model);

            $this->response->header('Location', '/users/' . $model->slug);
            return $this->response->send([
                'authkey' => $model->authkey
            ], 201);
        } catch (UsernameIsRequiredException $e) {
            return $this->response->send([
                'code'    => CreateAction::USERNAME_IS_REQUIRED,
                'message' => '`username` is required'
            ], 400);
        } catch (UsernameAlreadyExistsException $e) {
            return $this->response->send([
                'code'    => CreateAction::USERNAME_ALREADY_EXISTS,
                'message' => '`username` already exists'
            ], 400);
        } catch (EmailIsRequiredException $e) {
            return $this->response->send([
                'code'    => CreateAction::EMAIL_IS_REQUIRED,
                'message' => '`email` is required'
            ], 400);
        } catch (PasswordIsRequiredException $e) {
            return $this->response->send([
                'code'    => CreateAction::PASSWORD_IS_REQUIRED,
                'message' => '`password` is required'
            ], 400);
        } catch (PasswordNeedsToBeALengthOf64Exception $e) {
            return $this->response->send([
                'code'    => CreateAction::PASSWORD_IS_NOT_HASHED,
                'message' => '`password` is not sha256-hasehd'
            ], 400);
        }
    }
}
