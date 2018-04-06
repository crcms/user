<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-06 19:56
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Helpers\Hash;

use CrCms\App\Helpers\Hash\Contracts\Verify;
use CrCms\App\Helpers\Hash\Traits\VerifyTrait;

/**
 * Class Register
 * @package CrCms\User\Helpers\Hash
 */
class Register implements Verify
{
    use VerifyTrait;

    /**
     * @param array $values
     * @return string
     */
    protected function combination(array $values): string
    {
        $data = [
            'id' => strval($values['id']),
            'sign' => strval($values['sign']),
            'key' => config('app.key'),
            'time' => strval($values['time']),
        ];

        return implode(',', $data);
    }
}