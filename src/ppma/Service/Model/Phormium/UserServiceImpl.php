<?php


namespace ppma\Service\Model\Phormium;


use Cocur\Slugify\Slugify;
use ppma\Model\UserModel;
use ppma\Service\Model\Exception\EmailIsRequiredException;
use ppma\Service\Model\Exception\PasswordIsRequiredException;
use ppma\Service\Model\Exception\PasswordNeedsToBeALengthOf64Exception;
use ppma\Service\Model\Exception\UsernameAlreadyExistsException;
use ppma\Service\Model\Exception\UsernameIsRequiredException;
use ppma\Service\Model\Exception\UserNotFoundException;
use ppma\Service\Model\UserService;
use ppma\Service\Model\PhormiumServiceImpl;
use Rych\Random\Random;


class UserServiceImpl extends PhormiumServiceImpl implements UserService
{




    /**
     * @param UserModel $model
     * @throws \ppma\Service\Model\Exception\UsernameIsRequiredException
     * @throws \ppma\Service\Model\Exception\EmailIsRequiredException
     * @throws \ppma\Service\Model\Exception\PasswordNeedsToBeALengthOf64Exception
     * @throws \ppma\Service\Model\Exception\UsernameAlreadyExistsException
     * @throws \ppma\Service\Model\Exception\PasswordIsRequiredException
     */
    public function create(UserModel $model)
    {
        $this->validateEmail($model->email);
        $this->validatePassword($model->password);
        $this->validateUsername($model->username);
        $model->slug     = $this->slugUsername($model->username);
        $model->password = password_hash($model->password, PASSWORD_BCRYPT, ['costs' => 31]);
        $model->authkey  = $this->generateAuthkey();

        $model->save();
    }

    /**
     * @param UserModel $model
     * @return UserModel
     */
    public function createNewAuthKey(UserModel $model)
    {
        $model->authkey = $this->generateAuthkey();
        $model->save();

        return $model;
    }

    /**
     * @return string
     */
    private function generateAuthkey()
    {
        $authkey = sha1((new Random())->getRandomBytes(42));

        if (UserModel::objects()->filter('authkey', '=', $authkey)->exists())
        {
            return $this->generateAuthkey();
        }

        return $authkey;
    }

    /**
     * @return UserModel[]
     */
    public function getAll()
    {
        return UserModel::objects()->fetch();
    }

    /**
     * @param int $id
     * @return UserModel
     */
    public function getById($id)
    {
        return UserModel::get($id);
    }

    /**
     * @param string $slug
     * @return \Phormium\Model
     * @throws \ppma\Service\Model\Exception\UserNotFoundException
     */
    public function getBySlug($slug)
    {
        try {
            return UserModel::objects()->filter('slug', '=', $slug)->single();

        } catch (\Exception $e) {
            throw new UserNotFoundException();
        }
    }


    /**
     * @param string $username
     * @return \Phormium\Model|UserModel
     * @throws \ppma\Service\Model\Exception\UserNotFoundException
     */
    public function getByUsername($username)
    {
        try {
            return UserModel::objects()->filter('username', '=', $username)->single();

        } catch (\Exception $e) {
            throw new UserNotFoundException();
        }
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = []) { }

    /**
     * @param string $username
     * @param int $counter
     * @return string
     */
    protected function slugUsername($username, $counter = 1)
    {
        $slug = (new Slugify(Slugify::MODEARRAY))->slugify($username);

        if (UserModel::objects()->filter('slug', '=', $slug)->exists())
        {
            if ($counter != 1)
            {
                $slug = substr($slug, 0, -2);
            }

            $counter++;
            $slug = sprintf('%s-%d', $slug, $counter);
            return $this->slugUsername($slug, $counter);
        }

        return $slug;
    }

    /**
     * @param UserModel $model
     * @param string $email
     * @return void
     */
    public function updateEmail(UserModel $model, $email)
    {
        $model->email = $email;
        $model->save();
    }

    /**
     * @param UserModel $model
     * @param string $password
     * @throws \Exception
     * @throws \ppma\Service\Model\Exception\PasswordNeedsToBeALengthOf64Exception
     */
    public function updatePassword(UserModel $model, $password)
    {
        try {
            $this->validatePassword($password);
        } catch (PasswordNeedsToBeALengthOf64Exception $e) {
            throw $e;
        }

        $model->password = $password;
        $model->save();
    }

    /**
     * @param UserModel $model
     * @param null|array
     * @throws \ppma\Service\Model\Exception\UsernameIsRequiredException
     * @throws \ppma\Service\Model\Exception\EmailIsRequiredException
     * @throws \ppma\Service\Model\Exception\PasswordNeedsToBeALengthOf64Exception
     * @throws \ppma\Service\Model\Exception\UsernameAlreadyExistsException
     * @throws \ppma\Service\Model\Exception\PasswordIsRequiredException
     */
    public function update(UserModel $model, $validate = null)
    {
        if ($validate == null)
        {
            $validate = ['email', 'password', 'username'];
        }

        if (in_array('email', $validate))
        {
            $this->validateEmail($model->email);
        }

        if (in_array('password', $validate))
        {
            $this->validatePassword($model->password);
        }

        if (in_array('username', $validate))
        {
            $this->validateUsername($model->username, $model);
        }

        $model->save();
    }

    /**
     * @param $email
     * @throws \ppma\Service\Model\Exception\EmailIsRequiredException
     */
    private function validateEmail($email)
    {
        // check if email is empty
        if (strlen($email) == 0)
        {
            throw new EmailIsRequiredException();
        }
    }

    /**
     * @param string $password
     * @throws \ppma\Service\Model\Exception\PasswordNeedsToBeALengthOf64Exception
     */
    private function validatePassword($password)
    {
        // check if password is sha256 (has a length of 64)
        if (strlen($password) != 64)
        {
            throw new PasswordNeedsToBeALengthOf64Exception();
        }
    }

    /**
     * @param string $username
     * @param UserModel $user
     * @throws \ppma\Service\Model\Exception\UsernameAlreadyExistsException
     * @throws \ppma\Service\Model\Exception\UsernameIsRequiredException
     */
    private function validateUsername($username, UserModel $user = null)
    {
        // check if username is empty
        if (strlen($username) == 0)
        {
            throw new UsernameIsRequiredException();
        }

        // find username in db
        $dbuser = UserModel::objects()->filter('username', '=', $username)->single(true);

        // check if is username already taken
        if ($dbuser instanceof UserModel)
        {
            if (($user instanceof UserModel && $user->id != $dbuser->id) || !($user instanceof UserModel))
            {
                throw new UsernameAlreadyExistsException();
            }
        }
    }

}