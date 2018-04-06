<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-06 10:36
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Repositories;

use CrCms\Foundation\App\Repositories\AbstractRepository;
use CrCms\User\Models\LoginInfoModel;

/**
 * Class LoginInfoRepository
 * @package CrCms\User\Repositories
 */
class LoginInfoRepository extends AbstractRepository
{
    /**
     * @var array
     */
    protected $guard = ['created_at', 'ip', 'agent', 'user_id'];

    /**
     * @return LoginInfoModel
     */
    public function newModel(): LoginInfoModel
    {
        return app(LoginInfoModel::class);
    }
}