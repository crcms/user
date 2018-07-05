<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-06 10:59
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Listeners;

use CrCms\User\Mail\RegisterMail;
use CrCms\User\Repositories\AuthLogRepository;
use CrCms\User\Repositories\UserBehaviorRepository;
use CrCms\User\Services\Behaviors\RegisterMailBehavior;
use CrCms\User\Services\Verification\RegisterMailVerification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * Class RegisterMailListener
 * @package CrCms\User\Listeners
 */
class RegisterMailListener
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(Registered $registered)
    {
        Mail::to($registered->user->email)
            ->queue(
                (new RegisterMail($registered->user,$this->request->all()))
                    ->onQueue('emails')
            );
    }
}