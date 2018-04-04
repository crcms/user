<?php

namespace CrCms\Module\Http\Resources;

use CrCms\Foundation\App\Http\Resources\Resource;

class ModuleResource extends Resource
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
            'sign' => $this->sign,
            'namespace' => $this->namespace,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }

}