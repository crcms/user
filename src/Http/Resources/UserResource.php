<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-05 16:57
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Http\Resources;

use CrCms\Foundation\App\Http\Resources\Resource;

/**
 * Class UserResource
 * @package CrCms\User\Http\Resources
 */
class UserResource extends Resource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}