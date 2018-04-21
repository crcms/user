<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-21 11:00
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Services\Verification;

use CrCms\User\Services\Verification\Contracts\VerificationCode as VerificationCodeContract;
use Illuminate\Support\Str;

/**
 * Class VerificationCode
 * @package CrCms\Modules\user\src\Services\Verification
 */
class VerificationCode implements VerificationCodeContract
{
    /**
     * @param array $data
     * @return string
     */
    public function generate(array $data = []): string
    {
        return Str::random(6);
    }
}