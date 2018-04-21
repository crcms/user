<?php

namespace CrCms\User\Services\Verification;

use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Models\UserVerificationModel;
use CrCms\User\Services\Verification\Contracts\Verification;
use Illuminate\Http\Request;
use CrCms\User\Repositories\UserVerificationRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

abstract class AbstractVerification implements Verification
{
    /**
     * @var UserVerificationRepository
     */
    protected $userVerificationRepository;

    /**
     * @var UserVerificationModel
     */
    protected $userVerification;

    /**
     * @var Request
     */
    protected $request;

    /**
     * Register constructor.
     * @param Request $request
     * @param UserVerificationRepository $userVerificationRepository
     */
    public function __construct(Request $request, UserVerificationRepository $userVerificationRepository)
    {
        $this->request = $request;
        $this->userVerificationRepository = $userVerificationRepository;
    }

    /**
     * @return UserVerificationModel
     */
    public function getUserVerification(): UserVerificationModel
    {
        return $this->userVerification;
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
     * @param int $status
     * @param null|string $ip
     * @return UserVerificationModel
     */
    protected function setErrorUpdate(int $status = UserAttribute::VERIFY_STATUS_ERROR, ?string $ip = null): UserVerificationModel
    {
        return $this->userVerificationRepository->update([
            'status' => $status,
            'ip' => $ip ? $ip : $this->request->ip(),
        ], $this->userVerification->id);
    }

    /**
     * @return bool
     */
    protected function checkVerified(): bool
    {
        return $this->userVerification->status !== UserAttribute::VERIFY_STATUS_NO;
    }

    /**
     * @return bool
     */
    protected function checkExpired(): bool
    {
        return now()->diffInMinutes($this->userVerification->created_at) > config('user.verification_expired', 10);
    }

    /**
     * @param int $userId
     * @param string $code
     * @return UserVerificationModel
     */
    protected function userVerification(int $userId, string $code): UserVerificationModel
    {
        return $this->userVerificationRepository->notVerifyByUserIdAndExt($userId, $code);
    }

    /**
     * @param UserVerificationModel $userVerification
     * @return AbstractVerification
     */
    protected function setUserVerification(UserVerificationModel $userVerification): self
    {
        $this->userVerification = $userVerification;
        return $this;
    }

    /**
     * @param array $data
     * @return UserVerificationModel
     */
    public function update(array $data = []): UserVerificationModel
    {
        $data = array_merge([
            'status' => UserAttribute::VERIFY_STATUS_SUCCESS,
            'ip' => $this->request->ip(),
        ], $data);

        $userVerification = $this->userVerificationRepository->update($data, $this->userVerification->id);

        $this->setUserVerification($userVerification);

        return $userVerification;
    }

    /**
     * @param array $data
     * @return Validator
     */
//    abstract protected function validator(array $data): \Illuminate\Validation\Validator;
}