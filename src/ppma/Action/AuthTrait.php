<?php


namespace ppma\Action;


use ppma\Action\Exception\AccessDeniedException;
use ppma\Logger;
use ppma\Model\UserModel;
use ppma\Service\RequestService;

trait AuthTrait
{

    /**
     * @param UserModel $user
     * @param RequestService $request
     * @throws Exception\AccessDeniedException
     */
    protected function checkAccess(UserModel $user, RequestService $request)
    {
        Logger::debug('execute checkAccess()', __CLASS__);
        Logger::info(sprintf('check access of user "%s" with `id` %d', $user->username, $user->id), __CLASS__);

        $authkey = $request->header('X-Authkey');;

        if ($authkey === null || $user->authkey != $authkey)
        {
            Logger::warn(sprintf('access denied for user "%s" with `id` %d', $user->username, $user->id), __CLASS__);
            throw new AccessDeniedException();
        }
    }

} 