<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-07 20:21
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Services\Verification\Contracts;

use CrCms\User\Models\UserVerificationModel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Interface Verification
 * @package CrCms\User\Services\Verification\Contracts
 */
interface Verification
{
    /**
     * @param Request $request
     * @throws ValidationException
     * @return bool
     */
    public function validate(Request $request): bool;

    /**
     * @param int $userId
     * @param int $type
     * @return UserVerificationModel
     */
    public function create(int $userId, int $type): UserVerificationModel;

    /**
     * @param int $verificationId
     * @param int $status
     * @return UserVerificationModel
     */
//    public function update(int $verificationId, int $status): UserVerificationModel;
}