<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-07 20:25
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\User\Services\Verification;

use Carbon\Carbon;
use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Models\UserVerificationModel;
use CrCms\User\Repositories\UserVerificationRepository;
use CrCms\User\Services\Verification\Contracts\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;
use CrCms\User\Helpers\Hash\Register as RegisterHash;

/**
 * Class Register
 * @package CrCms\User\Services\Verification
 */
class Register implements Verification
{
    /**
     * @var RegisterHash
     */
    protected $registerHash;

    /**
     * @var UserVerificationRepository
     */
    protected $userVerificationRepository;

    /**
     * Register constructor.
     * @param UserVerificationRepository $userVerificationRepository
     */
    public function __construct(UserVerificationRepository $userVerificationRepository)
    {
        $this->userVerificationRepository = $userVerificationRepository;
    }

    /**
     * @param Request $request
     * @return bool
     * @throws ValidationException
     */
    public function validate(Request $request): bool
    {
        $data = $request->all();

        $this->validator($data)->validate();

        $userVerification = $this->userVerificationRepository->byIntIdOrFail($request->input('id'));

        $this->checkHash($userVerification, $data);

        $this->checkTime($userVerification);

        $this->checkVerified($userVerification);

        return true;
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
     * @param UserVerificationModel $userVerification
     * @return bool
     * @throws ValidationException
     */
    protected function checkVerified(UserVerificationModel $userVerification): bool
    {
        if ($userVerification->status === UserAttribute::VERIFY_STATUS_SUCCESS) {
            $this->throwError([
                'id' => [trans('user::verify_mail.verified')],
            ]);
        }

        return true;
    }

    /**
     * @param UserVerificationModel $userVerification
     * @param array $data
     * @return bool
     * @throws ValidationException
     */
    protected function checkHash(UserVerificationModel $userVerification, array $data): bool
    {
        if (!Hash::check(implode(',',[
                'id' => $userVerification->id,
                'sign' => $data['sign'],
                'time' => $userVerification->created_at->getTimestamp(),
            ]) . config('app.key'),$data['hash'])) {

            $this->throwError([
                'hash' => [trans('user::verify_mail.hash_error')],
            ]);
        }

        return true;
    }

    /**
     * @param UserVerificationModel $userVerification
     * @throws ValidationException
     */
    protected function checkTime(UserVerificationModel $userVerification): bool
    {
        if (
            Carbon::now()->diffInMinutes($userVerification->created_at) > config('user.register_mail_time_interval', 10)
        ) {
            $this->throwError([
                'id' => [trans('user::verify_mail.time_error')],
            ]);
        }

        return true;
    }

    /**
     * @param array $errors
     * @throws ValidationException
     * @return void
     */
    protected function throwError(array $errors): void
    {
        throw ValidationException::withMessages($errors)->status(423);
    }

    /**
     * @param int $verificationId
     * @param int $status
     * @return UserVerificationModel
     */
    public function update(int $verificationId, int $status): UserVerificationModel
    {
        return $this->userVerificationRepository->update([
            'user_id' => $verificationId,
            'status' => $status,
        ], $verificationId);
    }

    /**
     * @param int $userId
     * @param int $type
     * @return UserVerificationModel
     */
    public function create(int $userId, int $type): UserVerificationModel
    {
        return $this->userVerificationRepository->create([
            'user_id' => $userId,
            'type' => $type,
            'status' => UserAttribute::VERIFY_STATUS_NO,
        ]);
    }

    /**
     * @param UserVerificationModel $userVerification
     * @return array
     */
    public function options(UserVerificationModel $userVerification): array
    {
        $options = [
            'id' => $userVerification->id,
            'sign' => Str::random(10),
            'time' => $userVerification->created_at->getTimestamp(),
        ];

        $hash = Hash::make(
            implode(',', $options) . config('app.key')
        );

        return array_merge($options,['hash' => $hash]);
    }
}