<?php

namespace CrCms\User\Mail;

use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Models\UserModel;
use CrCms\User\Services\Verification\Contracts\Verification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var Verification
     */
    protected $verification;

    /**
     * @var UserModel
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserModel $userModel, Verification $verification)
    {
        $this->user = $userModel;
        $this->verification = $verification;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->verification->create(
            $this->user->id,
            UserAttribute::VERIFY_MAIL
        );
        $url = $this->verification->url();

        return $this->view('user::emails.register')->with([
            'url' => $url
        ]);
    }
}
