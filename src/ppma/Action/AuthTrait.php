<?php


namespace ppma\Action;


use Hahns\Request;
use ppma\Exception\Response\ForbiddenException;
use ppma\Logger;
use ppma\Model\User;

trait AuthTrait
{

    /**
     * @param User    $user
     * @param Request $request
     * @throws \ppma\Exception\Response\ForbiddenException
     */
    protected function checkAccess(User $user, Request $request)
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        Logger::info(sprintf('check access of user "%s" with `id` %d', $user->username, $user->id), __CLASS__);

        $authkey = $request->header('X-Authkey');

        if ($authkey === null || $user->authkey != $authkey) {
            Logger::warn(sprintf('access denied for user "%s" with `id` %d', $user->username, $user->id), __CLASS__);
            throw new ForbiddenException();
        }
    }

}
