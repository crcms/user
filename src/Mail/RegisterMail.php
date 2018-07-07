<?php

namespace CrCms\User\Mail;

use CrCms\User\Models\UserModel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class RegisterMail
 * @package CrCms\User\Mail
 */
class RegisterMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var UserModel
     */
    public $user;

    /**
     * @var string
     */
    public $url;

    /**
     * RegisterMail constructor.
     * @param UserModel $userModel
     * @param string $url
     */
    public function __construct(UserModel $userModel, string $url)
    {
        $this->user = $userModel;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('user::emails.register')->with([
            'url' => $this->url,
        ]);
    }
}
