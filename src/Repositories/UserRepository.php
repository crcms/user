<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-04 21:04
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Repositories;

use CrCms\Foundation\App\Repositories\AbstractRepository;
use CrCms\User\Models\UserModel;

/**
 * Class UserRepository
 * @package CrCms\User\Repositories
 */
class UserRepository extends AbstractRepository
{
    /**
     * @var array
     */
    protected $guard = ['name', 'email', 'password', 'tel'];

    /**
     * @return UserModel
     */
    public function newModel(): UserModel
    {
        return app(UserModel::class);
    }
}