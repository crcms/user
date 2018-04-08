<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-06 10:59
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Listeners;

use CrCms\User\Mail\RegisterMail;
use CrCms\User\Services\Verification\RegisterMailVerification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

/**
 * Class RegisterListener
 * @package CrCms\User\Listeners
 */
class RegisterListener
{
    /**
     * @var RegisterMailVerification
     */
    protected $registerVerification;

    /**
     * RegisterListener constructor.
     * @param RegisterMailVerification $registerVerification
     */
    public function __construct(RegisterMailVerification $registerVerification)
    {
        $this->registerVerification = $registerVerification;
    }

    /**
     * @param Registered $registered
     */
    public function handle(Registered $registered)
    {
        Mail::to($registered->user->email)
            ->queue(
                (new RegisterMail($registered->user, $this->registerVerification))
                    ->onQueue('emails')
            );
    }
}