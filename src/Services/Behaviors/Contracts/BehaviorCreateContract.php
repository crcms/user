<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018/7/6 6:07
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Services\Behaviors\Contracts;

use CrCms\User\Models\UserBehaviorModel;
use CrCms\User\Models\UserModel;
use Illuminate\Http\Request;

interface BehaviorCreateContract
{
    /**
     * @param array $data
     * @return UserBehaviorModel
     */
    public function create(array $data = []): UserBehaviorModel;
}