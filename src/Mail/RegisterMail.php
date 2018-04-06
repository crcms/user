<?php

namespace CrCms\User\Mail;

use CrCms\User\Models\UserModel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
//    public $queue = 'email';

    /**
     * @var UserModel
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserModel $userModel)
    {
        $this->user = $userModel;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('user::emails.register')->with([
            'url' => ''
        ]);
    }
}
