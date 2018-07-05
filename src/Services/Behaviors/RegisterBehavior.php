<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018/7/6 6:20
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Services\Behaviors;

use CrCms\User\Models\UserBehaviorModel;
use CrCms\User\Services\Behaviors\Contracts\BehaviorContract;
use Illuminate\Http\Request;

class RegisterBehavior extends AbstractBehavior implements BehaviorContract
{
    public function create(Request $request, array $data): UserBehaviorModel
    {
        // TODO: Implement create() method.
    }

    public function validate(Request $request): bool
    {
        // TODO: Implement validate() method.
    }

    public function update(Request $request, int $id, array $data = []): UserBehaviorModel
    {
        // TODO: Implement update() method.
    }
}