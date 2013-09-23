<?php


namespace ppma\Session;


use Keboola\Encryption\AesEncryptor;
use Silex\Application;

class User
{

    const SESSION_NAME = '__ppma_user';

    /**
     * @var int
     */
    protected $id;


    /**
     * @var string
     */
    protected $username;


    /**
     * @var string
     */
    protected $password;


    /**
     * @var string
     */
    protected $encrptionKey;


    /**
     * @var boolean
     */
    protected $isAdmin;


    /**
     * @var User
     */
    protected static $instance;


    /**
     * @return string
     */
    public function getEncrptionKey()
    {
        return $this->encrptionKey;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return boolean
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }


    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }


    /**
     * @return boolean
     */
    public function hasAccess()
    {
        return $this->id != null;
    }


    /**
     * @param \ppma\Entity\User $user
     * @param string            $password
     */
    public function setEntitiy(\ppma\Entity\User $user, $password)
    {
        $this->id           = $user->id;
        $this->username     = $user->username;
        $this->password     = $password;
        $this->isAdmin      = $user->isAdmin;

        // decrypt and save encryption key
        $crypter            = new AesEncryptor($this->password);
        $this->encrptionKey = $crypter->decrypt(base64_decode($user->encryptionKey));

        // set instance to session
        \ppma::instance()->session()->set(self::SESSION_NAME, $this);
    }

}