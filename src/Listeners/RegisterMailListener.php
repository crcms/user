<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-06 10:59
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Listeners;

use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Events\RegisteredEvent;
use CrCms\User\Mail\RegisterMail;
use CrCms\User\Models\UserBehaviorModel;
use CrCms\User\Repositories\AuthLogRepository;
use CrCms\User\Repositories\UserBehaviorRepository;
use CrCms\User\Services\Behaviors\AbstractBehavior;
use CrCms\User\Services\Behaviors\BehaviorFactory;
use CrCms\User\Services\Behaviors\Contracts\BehaviorContract;
use CrCms\User\Services\Behaviors\RegisterMailBehavior;
use CrCms\User\Services\Verification\RegisterMailVerification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

/**
 * Class RegisterMailListener
 * @package CrCms\User\Listeners
 */
class RegisterMailListener implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @param RegisteredEvent $registered
     */
    public function handle(RegisteredEvent $registered)
    {
        $registerBehavior = $this->registerBehavior($registered);

        $userBehavior = $registerBehavior->create($registered->data);

        Mail::to($registered->user->email)
            ->queue(
                (new RegisterMail($registered->user, $registerBehavior->generateRule()))
                    ->onQueue('emails')
            );
    }

    /**
     * @param RegisteredEvent $registered
     * @return \CrCms\User\Services\Behaviors\AbstractBehavior
     */
    protected function registerBehavior(RegisteredEvent $registered): AbstractBehavior
    {
        return BehaviorFactory::factory(UserAttribute::AUTH_TYPE_REGISTER_EMAIL_AUTHENTICATION, $registered->user);
    }
}