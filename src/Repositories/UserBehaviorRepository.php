<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018/7/6 6:18
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Repositories;

use CrCms\Foundation\App\Repositories\AbstractRepository;
use CrCms\User\Models\UserBehaviorModel;

class UserBehaviorRepository extends AbstractRepository
{
    /**
     * @var array
     */
    protected $guard = [
        'type', 'status', 'ip', 'extension', 'user_id', 'agent'
    ];

    /**
     * @return UserBehaviorModel
     */
    public function newModel(): UserBehaviorModel
    {
        return app(UserBehaviorModel::class);
    }
}