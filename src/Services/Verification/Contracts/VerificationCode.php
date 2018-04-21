<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-21 10:59
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Services\Verification\Contracts;

/**
 * Interface VerificationCode
 * @package CrCms\Modules\user\src\Services\Verification\Contracts
 */
interface VerificationCode
{
    /**
     * @param array $data
     * @return string
     */
    public function generate(array $data = []): string ;
}