<?php


namespace ppma\Service;


class Password extends ServiceImpl
{

    /**
     * @param string $password
     * @return string
     */
    public function hash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 31]);
    }

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function verify($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
