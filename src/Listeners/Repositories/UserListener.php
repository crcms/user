<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-04 21:16
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Listeners\Repositories;

use CrCms\User\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserListener
 * @package CrCms\User\Listeners\Repositories
 */
class UserListener
{
    /**
     * @param UserRepository $userRepository
     * @param array $data
     */
    public function creating(UserRepository $userRepository,array $data)
    {
        $userRepository->addData([
            'password' => Hash::make($data['password']),
        ]);
    }
}