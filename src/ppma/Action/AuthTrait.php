<?php


namespace ppma\Action;


use ppma\Action\Exception\AccessDeniedException;
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
        $authkey = $request->header('X-Authkey');;

        if ($authkey === null || $user->authkey != $authkey)
        {
            throw new AccessDeniedException();
        }
    }

} 