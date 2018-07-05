<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018/7/5 22:33
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Listeners\Repositories;

use CrCms\User\Repositories\AuthLogRepository;

class AuthLogListener
{
    /**
     * @param UserRepository $userRepository
     * @param array $data
     */
    public function creating(AuthLogRepository $authLogRepository, array $data)
    {
        if (isset($data['extension'])) {
            $authLogRepository->addData([
                'extension' => json_encode($data['extension'])
            ]);
        }
    }
}