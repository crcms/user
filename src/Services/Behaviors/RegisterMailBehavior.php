<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018/7/6 6:23
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Services\Behaviors;

use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Models\UserBehaviorModel;
use CrCms\User\Services\Behaviors\Contracts\BehaviorCheckContract;
use CrCms\User\Services\Behaviors\Contracts\BehaviorCreateContract;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * Class RegisterMailBehavior
 * @package CrCms\User\Services\Behaviors
 */
class RegisterMailBehavior extends AbstractBehavior implements BehaviorCreateContract, BehaviorCheckContract
{
    /**
     * @param array $data
     * @return UserBehaviorModel
     */
    public function create(array $data = []): UserBehaviorModel
    {
        $extensions = [
            'user_id' => $this->user->id,
            'expired_at' => now()->addHours(2)->getTimestamp(),
            'secret' => Str::random(6),
        ];

        $extensions['hash'] = Hash::make(implode('.', $extensions));
        $extensions['redirect'] = 'auth.login';

        $userBehavior = $this->userBehaviorRepository()->create([
            'user_id' => $this->user->id,
            'type' => UserAttribute::AUTH_TYPE_REGISTER_EMAIL_AUTHENTICATION,
            'status' => UserAttribute::AUTH_STATUS_DEFAULT,
            'extension' => $extensions,
            'ip' => $data['ip'] ?? '0.0.0.0',
            'agent' => $data['agent'] ?? ''
        ]);

        $this->setUserBehavior($userBehavior);

        return $userBehavior;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function validateRule(int $id): bool
    {
        $userBehavior = $this->userBehaviorRepository()->byIntIdOrFail($id);

        //一堆验证处理


        $this->setUserBehavior($this->update($id));

        return true;
    }

    /**
     * @return string
     */
    public function generateRule(): string
    {
        $urlQuery = (array)$this->userBehavior->extension;

        $urlQuery['behavior_id'] = $this->userBehavior->id;
        $urlQuery['behavior_type'] = $this->userBehavior->type;

        return URL::temporarySignedRoute('user.auth.behavior_auth.get', $this->userBehavior->extension->expired_at, $urlQuery);
    }
}