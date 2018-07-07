<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-07-07 09:47
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Services\Behaviors;

use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Models\UserBehaviorModel;
use CrCms\User\Services\Behaviors\Contracts\BehaviorCheckContract;
use CrCms\User\Services\Behaviors\Contracts\BehaviorCreateContract;

/**
 * Class ForgetPasswordBehavior
 * @package CrCms\User\Services\Behaviors
 */
class ForgetPasswordBehavior extends AbstractBehavior implements BehaviorCreateContract, BehaviorCheckContract
{
    public function validateRule(int $id): bool
    {
        // TODO: Implement validateRule() method.
    }

    public function generateRule(): string
    {
        // TODO: Implement generateRule() method.
    }

    public function create(array $data = []): UserBehaviorModel
    {
        $userBehavior = $this->userBehaviorRepository()->create([
            'user_id' => $this->user->id,
            'type' => UserAttribute::AUTH_TYPE_FORGET_PASSWORD,
            'status' => UserAttribute::AUTH_STATUS_DEFAULT,
            'ip' => $data['ip'] ?? '0.0.0.0',
            'agent' => $data['agent'] ?? '',
        ]);

        $this->setUserBehavior($userBehavior);

        return $userBehavior;
    }


}