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
 * Class AuthInfoEvent
 * @package CrCms\User\Events
 */
class AuthInfoEvent
{
    use SerializesModels;

    /**
     * @var UserModel
     */
    public $user;

    /**
     * @var int
     */
    public $type;

    /**
     * LoginedEvent constructor.
     * @param UserModel $userModel
     */
    public function __construct(UserModel $userModel,int $type)
    {
        $this->user = $userModel;
        $this->type = $type;
    }
}