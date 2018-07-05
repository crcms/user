<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018/7/5 21:44
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Repositories;

use CrCms\Foundation\App\Repositories\AbstractRepository;
use CrCms\User\Models\AuthLogModel;

class AuthLogRepository extends AbstractRepository
{
    /**
     * @var array
     */
    protected $guard = [
        'type', 'status', 'ip', 'extension', 'user_id', 'agent'
    ];

    /**
     * @return AuthLogModel
     */
    public function newModel(): AuthLogModel
    {
        return app(AuthLogModel::class);
    }
}