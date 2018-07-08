<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-07-08 07:47
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Events;

use CrCms\User\Models\UserModel;

/**
 * Class ForgetPasswordEvent
 * @package CrCms\User\Events
 */
class ForgetPasswordEvent extends BehaviorCreatedEvent
{
    /**
     * @var string
     */
    public $token;

    /**
     * ForgetPasswordEvent constructor.
     * @param UserModel $userModel
     * @param int $type
     * @param string $token
     * @param array $data
     */
    public function __construct(UserModel $userModel, int $type, string $token, array $data = [])
    {
        parent::__construct($userModel, $type, $data);
        $this->token = $token;
    }
}