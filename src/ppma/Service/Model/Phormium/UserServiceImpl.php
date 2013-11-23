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
     * @return UserModel[]
     */
    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    /**
     * @param int $id
     * @return UserModel
     */
    public function getById($id)
    {
        // TODO: Implement getById() method.
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
    public function init($args = [])
    {
        // TODO: Implement init() method.
    }

    /**
     * @param string $username
     * @param string $email
     * @param string $password
     * @return UserModel
     * @throws \ppma\Service\Model\Exception\UsernameIsRequiredException
     * @throws \ppma\Service\Model\Exception\EmailIsRequiredException
     * @throws \ppma\Service\Model\Exception\PasswordNeedsToBeALengthOf64Exception
     * @throws \ppma\Service\Model\Exception\UsernameAlreadyExistsException
     * @throws \ppma\Service\Model\Exception\PasswordIsRequiredException
     */
    public function create($username, $email, $password)
    {
        $model = new UserModel();

        // check if username is empty
        if (strlen($username) == 0)
        {
            throw new UsernameIsRequiredException();
        }

        // check if is username already taken
        if (UserModel::objects()->filter('username', '=', $username)->exists())
        {
            throw new UsernameAlreadyExistsException();
        }

        // check if email is empty
        if (strlen($email) == 0)
        {
            throw new EmailIsRequiredException();
        }

        // check if password is empty
        if (strlen($password) == 0)
        {
            throw new PasswordIsRequiredException();
        }

        // check if password is sha256 (has a length of 64)
        if (strlen($password) != 64)
        {
            throw new PasswordNeedsToBeALengthOf64Exception();
        }

        $model->username = $username;
        $model->slug     = $this->slugUsername($model->username);
        $model->email    = $email;
        $model->password = password_hash($password, PASSWORD_BCRYPT, ['costs' => 31]);
        $model->authkey  = sha1((new Random())->getRandomBytes(42));
        $model->save();

        return $model;
    }

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


}