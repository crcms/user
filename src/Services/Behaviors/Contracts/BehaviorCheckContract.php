<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018/7/7 7:24
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Services\Behaviors\Contracts;

use CrCms\User\Models\UserBehaviorModel;

/**
 * Interface BehaviorCheckContract
 * @package CrCms\User\Services\Behaviors\Contracts
 */
interface BehaviorCheckContract
{
    /**
     * @param int $id
     * @return bool
     */
    public function validateRule(int $id): bool;

    /**
     * @return string
     */
    public function generateRule(): string;
}