<?php

namespace CrCms\User\Attributes;

use CrCms\AttributeContract\AbstractAttributeContract;

/**
 * Class UserAttribute
 * @package CrCms\User\Attributes
 */
class UserAttribute extends AbstractAttributeContract
{
    /**
     *
     */
    const STATUS_UNDEFINED = 0;

    /**
     *
     */
    const STATUS_NORMAL = 1;

    /**
     *
     */
    const STATUS_INACTIVATE = 2;

    /**
     *
     */
    const STATUS_DISABLE = 3;

    /**
     *
     */
    const KEY_STATUS = 'status';

    /**
     * @return array
     */
    protected function attributes(): array
    {
        return [
            static::KEY_STATUS => [
                static::STATUS_UNDEFINED => trans('user::lang.status.undefined'),
                static::STATUS_NORMAL => trans('user::lang.status.normal'),
                static::STATUS_INACTIVATE => trans('user::lang.status.inactivate'),
                static::STATUS_DISABLE => trans('user::lang.status.disable')
            ]
        ];
    }
}