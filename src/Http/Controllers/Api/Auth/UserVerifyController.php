<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-06 19:12
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Http\Controllers\Api\Auth;

use CrCms\Foundation\App\Http\Controllers\Controller;
use CrCms\User\Helpers\Hash\Register;
use CrCms\User\Services\Verification\Verification;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Class UserVerifyController
 * @package CrCms\User\Http\Controllers\Api\Auth
 */
class UserVerifyController extends Controller
{
    protected $registerVerify;

    /**
     * MailVerifyController constructor.
     * @param Register $register
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     * @param int $type
     */
    public function postVerify(Request $request)
    {
        $verification = Verification::factory($request->input('type'));
        if ($verification->validate()) {
            $verification->update();
        }

        return $this->response->noContent();
    }
}