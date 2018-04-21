<?php

namespace CrCms\User\Http\Controllers\Api\Auth;

use CrCms\Foundation\App\Http\Controllers\Controller;
use CrCms\User\Services\Verification\Contracts\Verification;
use CrCms\User\Services\Verification\Contracts\VerificationCode;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

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
     * ForgotPasswordController constructor.
     * @param Verification $verification
     * @param VerificationCode $verificationCode
     */
    public function __construct()
    {
        parent::__construct();
//        $this->middleware('guest');
    }
//
//    public function sendResetLinkEmail(Request $request)
//    {
//        echo 122;
//        dd(123);
//    }
}
