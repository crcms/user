<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-04 21:04
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Repositories;

use CrCms\Foundation\App\Handlers\Contracts\JWTPassportContract;
use CrCms\Foundation\App\Repositories\AbstractRepository;
use CrCms\User\Models\UserModel;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class UserRepository
 * @package CrCms\User\Repositories
 */
class UserRepository extends AbstractRepository implements JWTPassportContract
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

    /**
     * @param string $ticket
     * @return JWTSubject
     */
    public function getUser(string $ticket): JWTSubject
    {
        return $this->where('ticket',$ticket)->firstOrFail();
    }
}