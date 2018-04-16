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
use CrCms\User\Models\UserVerificationModel;

/**
 * Class UserVerificationResource
 * @package CrCms\User\Http\Resources
 */
class UserVerificationResource extends Resource
{

    public function toArray($request)
    {
        return [
            'type' => UserAttribute::getStaticTransform(UserAttribute::KEY_AUTH_TYPE.'.'.$this->type),

        ];
    }

    /**
     * @param UserVerificationModel $userVerificationModel
     * @return array
     */
    protected function includeUser(UserVerificationModel $userVerificationModel)
    {
        return [
            'name' => $userVerificationModel->hasOneUser->name,
            'email' => $userVerificationModel->hasOneUser->email,
            'tel' => $userVerificationModel->hasOneUser->tel,
        ];
    }
}