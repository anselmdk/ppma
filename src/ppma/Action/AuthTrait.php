<?php


namespace ppma\Action;


use ppma\Action\Exception\AccessDeniedException;
use ppma\Logger;
use ppma\Model\UserModel;
use ppma\Service\RequestService;
use ppma\Service\ResponseService;

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

    /**
     * @param ResponseService $response
     * @return ResponseService
     */
    protected function prepare403Response(ResponseService $response)
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        return $response
            ->addData('code', 101)
            ->addData('message', 'access forbidden')
            ->setStatusCode(403)
        ;
    }

} 