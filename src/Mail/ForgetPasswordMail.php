<?php

namespace CrCms\User\Mail;

use CrCms\User\Models\UserBehaviorModel;
use CrCms\User\Models\UserModel;
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
     * @var UserBehaviorModel 
     */
    public $userBehavior;

    /**
     * @var string
     */
    public $url;

    /**
     * RegisterMail constructor.
     * @param UserModel $userModel
     * @param string $url
     */
    public function __construct(UserModel $userModel, UserBehaviorModel $userBehaviorModel,string $url)
    {
        $this->user = $userModel;
        $this->userBehavior = $userBehaviorModel;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('user::emails.forget_password')->with([
            'url' => $this->url,
        ]);
    }
}
