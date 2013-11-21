<?php


namespace ppma\Service\Database\Impl;


use Cocur\Slugify\Slugify;
use ppma\Model\UserModel;
use ppma\Service\Database\Exception\EmailIsRequiredException;
use ppma\Service\Database\Exception\PasswordIsRequiredException;
use ppma\Service\Database\Exception\PasswordNeedsToBeALengthOf64Exception;
use ppma\Service\Database\Exception\UsernameIsRequiredException;
use ppma\Service\Database\UserEntity;
use ppma\Service\Database\UserService;

class UserServiceImpl implements UserService
{
    /**
     * @return UserEntity[]
     */
    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    /**
     * @param int $id
     * @return UserEntity
     */
    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    /**
     * @param string $username
     * @return UserEntity
     */
    public function getByUsername($username)
    {
        // TODO: Implement getByUsername() method.
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = [])
    {
        // TODO: Implement init() method.
    }

    public function create($username, $email, $password)
    {
        $model = new UserModel();

        // check if username is empty
        if (strlen($username) == 0)
        {
            throw new UsernameIsRequiredException();
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
        $model->password = $password;
        $model->apikey   = sha1(rand());
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