<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-06 10:59
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Listeners;
use CrCms\User\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;

/**
 * Class RegisterListener
 * @package CrCms\User\Listeners
 */
class RegisterListener
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(Registered $registered)
    {
        $this->userRepository->update([

        ],$registered->user->id);
    }

}