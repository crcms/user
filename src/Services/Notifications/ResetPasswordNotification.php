<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-21 15:26
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Services\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class ResetPasswordNotification
 * @package CrCms\User\Services\Notifications
 */
class ResetPasswordNotification extends ResetPassword implements ShouldQueue
{
    use Queueable;

    /**
     * ResetPasswordNotification constructor.
     * @param string $token
     */
    public function __construct(string $token)
    {
        parent::__construct($token);
        $this->queue = 'emails';
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage)
            ->view('user::emails.forget_password', ['user' => $notifiable, 'token' => $this->token, 'expire' => config('user.verification_expire')]);
    }
}