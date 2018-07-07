<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018/07/06 09:24
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Listeners;

use CrCms\User\Events\BehaviorCreatedEvent;
use CrCms\User\Repositories\UserBehaviorRepository;
use CrCms\User\Services\Behaviors\AbstractBehavior;
use CrCms\User\Services\Behaviors\BehaviorFactory;
use CrCms\User\Services\Behaviors\Contracts\BehaviorContract;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/**
 * Class BehaviorCreatedListener
 * @package CrCms\User\Listeners
 */
class BehaviorCreatedListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @param BehaviorCreatedEvent $event
     */
    public function handle(BehaviorCreatedEvent $event)
    {
        return $this->behavior($event)->create($event->data);
    }

    /**
     * @return UserBehaviorRepository
     */
    protected function userBehaviorRepository(): UserBehaviorRepository
    {
        return app(UserBehaviorRepository::class);
    }

    /**
     * @param BehaviorCreatedEvent $event
     * @return AbstractBehavior
     */
    protected function behavior(BehaviorCreatedEvent $event): AbstractBehavior
    {
        return BehaviorFactory::factory($event->type, $event->user);
    }
}