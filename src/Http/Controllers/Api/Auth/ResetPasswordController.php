<?php

namespace CrCms\User\Http\Controllers\Api\Auth;

use CrCms\Foundation\App\Http\Controllers\Controller;
use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Events\AuthInfoEvent;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest');
    }

    /**
     * @param $user
     * @param $password
     */
    public function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);

        //$user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));
        event(new AuthInfoEvent($user, UserAttribute::AUTH_TYPE_RESET_PASSWORD));

        //$this->guard()->login($user);
    }

    /**
     * @param $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function sendResetResponse($response)
    {
        return $this->response->noContent();
    }

    /**
     * @param Request $request
     * @param $response
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        throw new UnprocessableEntityHttpException(trans($response));
    }
}
