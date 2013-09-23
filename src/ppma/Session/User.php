<?php


namespace ppma\Session;


use Keboola\Encryption\AesEncryptor;

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
     * @param \ppma\Entity\User $user
     */
    protected function __construct(\ppma\Entity\User $user)
    {
        $this->id           = $user->id;
        $this->username     = $user->username;
        $this->password     = $user->password;
        $this->isAdmin      = $user->isAdmin;

        // decrypt and save encryption key
        $crypter            = new AesEncryptor($this->password);
        $this->encrptionKey = $crypter->decrypt(base64_decode($user->encryptionKey));

        // set instance to session
        \ppma::instance()->session()->set(self::SESSION_NAME, $this);
    }


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
     * @param \ppma\Entity\User $user
     * @return User
     * @throws \RuntimeException
     */
    public static function instance(\ppma\Entity\User $user = null)
    {
        // create instance if $user setted
        if ($user instanceof \ppma\Entity\User)
        {
            self::$instance = new User($user);
        }

        // check of exist an instance
        if (!(self::$instance instanceof User))
        {
            // try to get user from session
            $user = \ppma::instance()->session()->get(self::SESSION_NAME, false);

            if (!$user)
            {
                throw new \RuntimeException();
            }
            else
            {
                self::$instance = $user;
            }
        }

        return self::$instance;
    }

}