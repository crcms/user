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
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Class MailVerifyController
 * @package CrCms\User\Http\Controllers\Api\Auth
 */
class MailVerifyController extends Controller
{
    protected $registerVerify;

    /**
     * MailVerifyController constructor.
     * @param Register $register
     */
    public function __construct(Register $register)
    {
        parent::__construct();
        $this->registerVerify = $register;
    }

    /**
     * @param Request $request
     */
    public function verify(Request $request)
    {
        $this->validator($request->all())->validate();

        if (!$this->checkHash($request->all(), $request->input('hash'))) {
            $this->verifyError();
        }
    }

    /**
     * @param array $data
     * @return Validator
     */
    protected function validator(array $data): Validator
    {
        return Validator::make($data, [
            'hash' => 'required|string',
            'id' => 'required|integer',
            'time' => 'required|integer',
            'sign' => 'required',
        ]);
    }

    /**
     * @param string $value
     * @param string $hash
     * @return bool
     */
    protected function checkHash(array $values,string $hash): bool
    {
        return $this->registerVerify->check($values,$hash);
    }

    /**
     * @throws ValidationException
     * @return void
     */
    protected function verifyError(): void
    {
        throw ValidationException::withMessages([
            'hash' => [trans('user::verify_mail.hash_error')],
        ])->status(423);
    }
}