<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-06 11:24
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Listeners;

use CrCms\User\Events\LoginedEvent;
use CrCms\User\Repositories\LoginInfoRepository;
use Illuminate\Http\Request;

/**
 * Class LoginedListener
 * @package CrCms\User\Listeners
 */
class LoginedListener
{
    /**
     * @var LoginInfoRepository
     */
    protected $loginInfoRepository;

    /**
     * @var Request
     */
    protected $request;

    /**
     * LoginedListener constructor.
     * @param LoginInfoRepository $loginInfoRepository
     * @param Request $request
     */
    public function __construct(LoginInfoRepository $loginInfoRepository, Request $request)
    {
        $this->loginInfoRepository = $loginInfoRepository;
        $this->request = $request;
    }

    /**
     * @param LoginedEvent $event
     */
    public function handle(LoginedEvent $event)
    {
        $this->loginInfoRepository->create([
           'created_at' => now(),
            'ip' => $this->request->ip(),
            'agent' => '',
            'user_id' => $event->user->id,
        ]);
    }
}