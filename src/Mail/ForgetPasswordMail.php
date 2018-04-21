<?php

namespace CrCms\User\Mail;

use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Models\UserModel;
use CrCms\User\Services\Verification\RegisterMailVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgetPasswordMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var UserModel
     */
    public $user;

    /**
     * @var string
     */
    public $token;

    /**
     * @var int
     */
    public $expire;

    /**
     * ForgetPasswordMail constructor.
     * @param UserModel $userModel
     * @param string $token
     * @param int $expire
     */
    public function __construct(UserModel $userModel, string $token, int $expire)
    {
        $this->user = $userModel;
        $this->token = $token;
        $this->expire = $expire;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('user::emails.forget_password');
    }
}
