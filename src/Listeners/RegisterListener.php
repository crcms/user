<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-06 10:59
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Listeners;
use CrCms\User\Helpers\Hash\Register;
use CrCms\User\Mail\RegisterMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use CrCms\User\Services\Verification\Register as RegisterVerification;

/**
 * Class RegisterListener
 * @package CrCms\User\Listeners
 */
class RegisterListener
{
    protected $registerVerify;

    protected $registerVerification;

    public function __construct(Register $register, RegisterVerification $registerVerification)
    {
        $this->registerVerify = $register;
        $this->registerVerification = $registerVerification;
    }

    /**
     * @param Registered $registered
     */
    public function handle(Registered $registered)
    {
        Mail::to($registered->user->email)
            ->queue(
                (new RegisterMail($registered->user,$this->registerVerify,$this->registerVerification))
                ->onQueue('emails')
            );
    }
}