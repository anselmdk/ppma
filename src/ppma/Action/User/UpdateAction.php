<?php


namespace ppma\Action\User;


use Nocarrier\Hal;
use ppma\Action\ActionImpl;
use ppma\Action\AuthTrait;
use ppma\Action\Exception\AccessDeniedException;
use ppma\Config;
use ppma\Logger;
use ppma\Service\Model\Exception\PasswordNeedsToBeALengthOf64Exception;
use ppma\Service\Model\UserService;
use ppma\Service\Request\HttpFoundationServiceImpl;

class UpdateAction extends ActionImpl
{

    use AuthTrait;

    const PASSWORD_IS_INVALID     = 1;
    const FORBIDDEN               = 101;
    const UNKNOWN_ERROR           = 999;

    /**
     * @var HttpFoundationServiceImpl
     */
    protected $request;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @return array
     */
    public function services()
    {
        Logger::debug('execute services()', __CLASS__);

        return array_merge(parent::services(), [
            array_merge(Config::get('services.model.user'), ['target' => 'userService']),
            array_merge(Config::get('services.request'),    ['target' => 'request'])
        ]);
    }

    public function init($args = [])
    {
        parent::init($args);
        $this->slug = $args['slug'];
    }


    /**
     * @return \ppma\Service\ResponseService
     */
    public function run()
    {
        Logger::debug('execute run()', __CLASS__);

        // prepare response
        $this->response
            ->addHeader('Content-Type', 'application/hal+json')
            ->setStatusCode(400)
        ;

        // create hal object
        $hal = new Hal('/users/' . $this->slug);

        try
        {
            // get user
            $model = $this->userService->getBySlug($this->slug);

            // check access
            $this->checkAccess($model, $this->request);

            // validator
            $validate = [];

            // set email
            if ($this->request->post('email', false) !== false)
            {
                $model->email = $this->request->post('email');
                $validate[]   = 'email';
            }

            // set password
            if ($this->request->post('password', false) !== false)
            {
                $model->password = $this->request->post('password');
                $validate[]      = 'password';
            }

            // save user
            $this->userService->update($model, $validate);

            // send response
            return $this->response
                ->setBody($hal->asJson())
                ->setStatusCode(200)
            ;

        } catch (PasswordNeedsToBeALengthOf64Exception $e) {
            $hal->setData([
                'code'    => self::PASSWORD_IS_INVALID,
                'message' => '`password` is not a sha256 hash'
            ]);

            return $this->response->setBody($hal->asJson());

        // unknown error
        } catch (\Exception $e) {
            Logger::error(sprintf("%s\n%s", get_class($e), $e->getTraceAsString()));

            $hal->setData([
                'code'    => self::UNKNOWN_ERROR,
                'message' => $e->getMessage()
            ]);

            return $this->response
                ->setBody($hal->asJson())
                ->setStatusCode(500);
        }
    }

} 