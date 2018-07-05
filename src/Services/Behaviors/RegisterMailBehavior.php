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
use CrCms\User\Models\UserModel;
use CrCms\User\Services\Behaviors\Contracts\BehaviorContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterMailBehavior extends AbstractBehavior implements BehaviorContract
{
    public function create(UserModel $userModel, ?Request $request = null, array $data = []): UserBehaviorModel
    {
        $extensions = [
            'user_id' => $userModel->id,
            'expired_at' => now()->addHours(2)->getTimestamp(),
            'secret' => Str::random(6),
        ];

        $extensions['hash'] = Hash::make(implode('.', $extensions));

        return $this->userBehaviorRepository->create([
            'user_id' => $userModel->id,
            'type' => UserAttribute::AUTH_TYPE_REGISTER_AUTHENTICATION,
            'status' => UserAttribute::AUTH_STATUS_DEFAULT,
            'extension' => $extensions,
            'ip' => $data['ip'] ?? '0.0.0.0',
            'agent' => $data['agent'] ?? ''
        ]);
    }

    public function validate(UserModel $userModel, Request $request): bool
    {
        // TODO: Implement validate() method.
    }

    public function update(int $id, UserModel $userModel, ?Request $request = null, array $data = []): UserBehaviorModel
    {
        // TODO: Implement update() method.
    }

}