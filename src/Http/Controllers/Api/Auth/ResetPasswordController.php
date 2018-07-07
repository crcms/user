<?php

namespace CrCms\User\Http\Controllers\Api\Auth;

use CrCms\Foundation\App\Http\Controllers\Controller;
use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Events\AuthInfoEvent;
use CrCms\User\Models\UserModel;
use CrCms\User\Services\Behaviors\BehaviorFactory;
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

    public function reset(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
            $this->resetPassword($user, $password);

        }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($response)
            : $this->sendResetFailedResponse($request, $response);
    }

    /**
     * @param $user
     * @param $password
     */
//    public function resetPassword($user, $password)
//    {
//        $user->password = Hash::make($password);
//
//        //$user->setRememberToken(Str::random(60));
//
//        $user->save();
//
//        event(new PasswordReset($user));
//        event(new AuthInfoEvent($user, UserAttribute::AUTH_TYPE_RESET_PASSWORD));
//
//        //$this->guard()->login($user);
//    }

//    protected function rules()
//    {
//        return [
//            'token' => 'required',
//            'email' => 'required|email',
//            'password' => 'required|confirmed|min:6',
//        ];
//    }

    /**
     * @param $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function sendResetResponse($response)
    {
        BehaviorFactory::factory(
            UserAttribute::AUTH_TYPE_FORGET_PASSWORD,
            $this->broker()->getUser
        );

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

    protected function forgetPasswordEvent(UserModel $userModel)
    {
        BehaviorFactory::factory(
            UserAttribute::AUTH_TYPE_FORGET_PASSWORD,
            $userModel,
            arr
        );
    }
}
