<?php

namespace CrCms\User\Mail;

use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Models\UserModel;
use CrCms\User\Services\Verification\RegisterMailVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

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
        $verification = $this->verification();

        $verification->create(
            $this->user->id,
            UserAttribute::VERIFY_MAIL
        );
        $url = $verification->url();

        return $this->view('user::emails.register')->with([
            'url' => $url
        ]);
    }

    /**
     * @return RegisterMailVerification
     */
    protected function verification(): RegisterMailVerification
    {
        return app(RegisterMailVerification::class);
    }
}
