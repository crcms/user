<?php

namespace CrCms\User\Mail;

use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Models\UserModel;
use CrCms\User\Repositories\AuthLogRepository;
use CrCms\User\Services\Behaviors\RegisterMailBehavior;
use CrCms\User\Services\Verification\RegisterMailVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class RegisterMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var UserModel
     */
    public $user;

    protected $data;

    public function __construct(UserModel $userModel, array $data)
    {
        $this->user = $userModel;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $behavior = $this->registerMailBehavior()->create($this->user, null, $this->data);
        $urlQuery = json_decode($behavior->extension, true);
        $urlQuery['log_id'] = $behavior->id;

        return $this->view('user::emails.register')->with([
            'url' => URL::temporarySignedRoute('auth_verification.post',$urlQuery['expired_at'],$urlQuery)//('auth_verification.post', $urlQuery),
        ]);
    }


    protected function registerMailBehavior(): RegisterMailBehavior
    {
        return app(RegisterMailBehavior::class);
    }
}
