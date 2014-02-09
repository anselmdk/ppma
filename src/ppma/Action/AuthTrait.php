<?php


namespace ppma\Action;


use ppma\Logger;
use ppma\Model\UserModel;

trait AuthTrait
{

    /**
     * @param UserModel $user
     * @param $request
     */
    protected function checkAccess(UserModel $user, $request)
    {
        /*
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        Logger::info(sprintf('check access of user "%s" with `id` %d', $user->username, $user->id), __CLASS__);

        $authkey = $request->header('X-Authkey');

        if ($authkey === null || $user->authkey != $authkey) {
            Logger::warn(sprintf('access denied for user "%s" with `id` %d', $user->username, $user->id), __CLASS__);
            error(403);
        }
        */
    }
}
