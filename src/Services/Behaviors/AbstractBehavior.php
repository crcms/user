<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018/7/6 6:20
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Services\Behaviors;

use CrCms\User\Repositories\UserBehaviorRepository;
use CrCms\User\Services\Behaviors\Contracts\BehaviorContract;

/**
 * Class AbstractBehavior
 * @package CrCms\User\Services\Behaviors
 */
abstract class AbstractBehavior implements BehaviorContract
{
    /**
     * @var UserBehaviorRepository
     */
    protected $userBehaviorRepository;

    /**
     * AbstractRegister constructor.
     * @param UserBehaviorRepository $userBehaviorRepository
     */
    public function __construct(UserBehaviorRepository $userBehaviorRepository)
    {
        $this->userBehaviorRepository = $userBehaviorRepository;
    }
}