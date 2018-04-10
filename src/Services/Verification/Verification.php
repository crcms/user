<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-09 21:35
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Services\Verification;

use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Services\Verification\Contracts\Verification as VerificationContract;
use InvalidArgumentException;

/**
 * Class Verification
 * @package CrCms\User\Services\Verification
 */
class Verification
{
    /**
     * @param int $type
     * @return VerificationContract
     */
    public static function factory(int $type): VerificationContract
    {
        switch ($type) {
            case UserAttribute::VERIFY_MAIL:
                return app(RegisterMailVerification::class);
                break;
            case UserAttribute::VERIFY_TEL:
                break;
            default:
                throw new InvalidArgumentException(trans('user::app.param_error'));
        }
    }

}