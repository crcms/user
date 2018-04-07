<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-07 20:54
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Repositories;

use CrCms\Foundation\App\Repositories\AbstractRepository;
use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Models\UserModel;
use CrCms\User\Models\UserVerificationModel;

/**
 * Class UserVerificationRepository
 * @package CrCms\User\Repositories
 */
class UserVerificationRepository extends AbstractRepository
{
    /**
     * @var array
     */
    protected $guard = ['user_id', 'type', 'status'];

    /**
     * @return UserVerificationModel
     */
    public function newModel(): UserVerificationModel
    {
        return app(UserVerificationModel::class);
    }

    /**
     * @param int $userId
     * @return bool
     */
    public function isVerifyMail(int $userId): bool
    {
        return (bool)$this->where('user_id',$userId)->where('status',UserAttribute::VERIFY_STATUS_SUCCESS)->first();
    }
}