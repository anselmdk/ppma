<?php


namespace ppma\Action\Auth;


use Nocarrier\Hal;
use ppma\Action\ActionImpl;
use ppma\Action\AuthTrait;
use ppma\Action\Exception\AccessDeniedException;
use ppma\Config;
use ppma\Logger;
use ppma\Service\Model\Exception\UserNotFoundException;
use ppma\Service\Model\UserService;
use ppma\Service\RequestService;
use ppma\Service\ResponseService;

class CreateNewKeyAction extends ActionImpl
{

    use AuthTrait;

    const FORBIDDEN     = 101;
    const UNKNOWN_ERROR = 999;

    /**
     * @var string
     */
    protected $authkey;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var RequestService
     */
    protected $request;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @param array $args
     */
    public function init($args = [])
    {
        Logger::debug('execute init()', __CLASS__);

        $this->$slug    = $args['slug'];
        $this->authkey  = $this->request->header('X-Authkey');
    }

    /**
     * @return array
     */
    public function services()
    {
        Logger::debug('execute services()', __CLASS__);

        return array_merge(parent::services(), [
            array_merge(Config::get('services.request'),    ['target' => 'request']),
            array_merge(Config::get('services.model.user'), ['target' => 'userService']),
        ]);
    }


    /**
     * @return ResponseService
     */
    public function run()
    {
        Logger::debug('execute run()', __CLASS__);

        // get user
        try {
            // get user
            $model = $this->userService->getBySlug($this->slug);

            // check access
            $this->checkAccess($model, $this->request);

            // create new key
            $this->userService->createNewAuthKey($model);

            // create hal object
            $hal = new Hal(sprintf('/users/%s/auth', $model->slug), [
                'key' => $model->authkey
            ]);
            $hal->addLink('user', sprintf('/users/%s', $model->slug));

            return $this->response
                ->setBody($hal->asJson())
                ->addHeader('Content-Type', 'application/hal+json');

        } catch (UserNotFoundException $e) {
        } catch (AccessDeniedException $e) {
        } catch (\Exception $e) {
            return $this->response
                ->addData('code', self::UNKNOWN_ERROR)
                ->addData('message', $e->getMessage())
                ->setStatusCode(500)
            ;
        }

        return $this->response
            ->addData('code', self::FORBIDDEN)
            ->addData('message', 'access forbidden')
            ->setStatusCode(403)
        ;
    }

} 