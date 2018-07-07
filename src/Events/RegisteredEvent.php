<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018/07/06 08:38
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Events;

use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Models\UserModel;
use CrCms\User\Services\Behaviors\Contracts\BehaviorContract;

/**
 * Class RegisteredEvent
 * @package CrCms\User\Events
 */
class RegisteredEvent extends BehaviorCreatedEvent
{
}