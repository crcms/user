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

/**
 * Interface BehaviorContract
 * @package CrCms\User\Services\Behaviors\Contracts
 */
interface BehaviorContract
{
    /**
     * @param UserModel $userModel
     * @param Request|null $request
     * @param array $data
     * @return UserBehaviorModel
     */
    public function create(UserModel $userModel, ?Request $request = null, array $data = []): UserBehaviorModel;

    /**
     * @param Request $request
     * @param UserModel $userModel
     * @return bool
     */
    public function validate(UserModel $userModel, Request $request): bool;

    /**
     * @param int $id
     * @param UserModel $userModel
     * @param Request|null $request
     * @param array $data
     * @return UserBehaviorModel
     */
    public function update(int $id, UserModel $userModel, ?Request $request = null, array $data = []): UserBehaviorModel;
}