<?php

namespace CrCms\User\Http\Controllers\Api\Auth;

use CrCms\Foundation\App\Http\Controllers\Controller;
use CrCms\User\Http\Requests\Auth\ResetPasswordUrlRequest;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * @param $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sendResetLinkResponse($response)
    {
        return $this->response->noContent();
    }

    /**
     * @param ResetPasswordUrlRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postResetPasswordUrl(ResetPasswordUrlRequest $request)
    {
        return $this->response->data([
            'url' => route('user.auth.reset_password.reset', $request->all())
        ]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

//    public function broker()
//    {
//        return Password::broker('test');
//    }
}
