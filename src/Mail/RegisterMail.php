<?php

namespace CrCms\User\Mail;

use CrCms\App\Helpers\Hash\Contracts\Verify;
use CrCms\User\Models\UserModel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var Verify
     */
    protected $verify;

    /**
     * @var UserModel
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserModel $userModel,Verify $verify)
    {
        $this->user = $userModel;
        $this->verify = $verify;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('user::emails.register')->with([
            'register_mail_verify.post' => $this->url()
        ]);
    }

    /**
     * @return string
     */
    protected function url(): string
    {
        $options = [
            'id' => $this->user->id,
            'sign' => str_random(10),
            'time' => now(),
        ];

        $hash = $this->verify->make($options);

        return route('register_mail_verify.post',array_merge($options,['hash'=>$hash]));
    }
}
