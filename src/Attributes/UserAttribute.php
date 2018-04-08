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
     *
     */
    const VERIFY_MAIL = 1;

    /**
     *
     */
    const VERIFY_TEL = 2;

    /**
     *
     */
    const KEY_VERIFY = 'verify';

    /**
     *
     */
    const VERIFY_STATUS_SUCCESS = 1;

    /**
     *
     */
    const VERIFY_STATUS_ERROR = 2;

    /**
     *
     */
    const VERIFY_STATUS_NO = 3;

    /**
     *
     */
    const KEY_VERIFY_STATUS = 'verify_status';

    /**
     *
     */
    const AUTH_TYPE_LOGIN = 1;

    /**
     *
     */
    const AUTH_TYPE_REGISTER = 2;

    /**
     *
     */
    const KEY_AUTH_TYPE = 'auth_type';

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