<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-16 21:15
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Http\Resources;

use CrCms\Foundation\App\Http\Resources\Resource;
use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Models\AuthInfoModel;
use CrCms\User\Models\UserVerificationModel;

/**
 * Class AuthInfoResource
 * @package CrCms\User\Http\Resources
 */
class AuthInfoResource extends Resource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'type_convert' => UserAttribute::getStaticTransform(UserAttribute::KEY_AUTH_TYPE . '.' . strval($this->type)),
            'ip' => $this->ip,
            'created_at' => $this->created_at->toDateTimeString(),
            'agent' => $this->agent,
        ];
    }

    /**
     * @param AuthInfoModel $authInfoModel
     * @return array
     */
    protected function includeUser(AuthInfoModel $authInfoModel)
    {
        return [
            'name' => $authInfoModel->hasOneUser->name,
            'email' => $authInfoModel->hasOneUser->email,
            'tel' => $authInfoModel->hasOneUser->tel,
        ];
    }
}