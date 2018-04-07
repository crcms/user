<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-06 11:22
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Events;

use CrCms\User\Models\UserModel;
use Illuminate\Queue\SerializesModels;

/**
 * Class LoginedEvent
 * @package CrCms\User\Events
 */
class LoginedEvent
{
    use SerializesModels;

    /**
     * @var UserModel
     */
    public $user;

    /**
     * LoginedEvent constructor.
     * @param UserModel $userModel
     */
    public function __construct(UserModel $userModel)
    {
        $this->user = $userModel;
    }
}