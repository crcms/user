<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-06 11:24
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Listeners;

use CrCms\User\Events\AuthInfoEvent;
use CrCms\User\Repositories\AuthInfoRepository;
use Illuminate\Http\Request;

/**
 * Class AuthInfoListener
 * @package CrCms\User\Listeners
 */
class AuthInfoListener
{
    /**
     * @var AuthInfoRepository
     */
    protected $authInfoRepository;

    /**
     * @var Request
     */
    protected $request;

    /**
     * LoginedListener constructor.
     * @param AuthInfoRepository $loginInfoRepository
     * @param Request $request
     */
    public function __construct(AuthInfoRepository $loginInfoRepository, Request $request)
    {
        $this->authInfoRepository = $loginInfoRepository;
        $this->request = $request;
    }

    /**
     * @param AuthInfoEvent $event
     */
    public function handle(AuthInfoEvent $event)
    {
        $this->authInfoRepository->create([
            'created_at' => now(),
            'ip' => $this->request->ip(),
            'type' => $event->type,
            'agent' => $this->request->userAgent(),
            'user_id' => $event->user->id,
        ]);
    }
}