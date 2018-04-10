<?php

namespace CrCms\User\Services\Verification;

use CrCms\Foundation\App\Helpers\Hash\Contracts\HashVerify;
use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Models\UserVerificationModel;
use CrCms\User\Repositories\UserVerificationRepository;
use CrCms\User\Services\Verification\Contracts\Verification;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ResetPasswordVerification implements Verification
{

    /**
     * @var UserVerificationRepository
     */
    protected $userVerificationRepository;

    /**
     * @var HashVerify
     */
    protected $hashVerify;

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
     * @param HashVerify $hashVerify
     * @param UserVerificationRepository $userVerificationRepository
     */
    public function __construct(Request $request, HashVerify $hashVerify, UserVerificationRepository $userVerificationRepository)
    {
        $this->request = $request;
        $this->hashVerify = $hashVerify;
        $this->userVerificationRepository = $userVerificationRepository;
    }

    public function validate(): bool
    {

    }

    public function create(int $userId, int $type, ?string $ext): UserVerificationModel
    {
        $userVerification = $this->userVerificationRepository->create([
            'user_id' => $userId,
            'type' => $type,
            'status' => UserAttribute::VERIFY_STATUS_NO,
            'ext' => strval($ext),
        ]);

        $this->setUserVerification($userVerification);

        return $userVerification;
    }


    public function update(array $data = []): UserVerificationModel
    {

    }

    /**
     * @param UserVerificationModel $userVerification
     * @return RegisterMailVerification
     */
    protected function setUserVerification(UserVerificationModel $userVerification): self
    {
        $this->userVerification = $userVerification;
        return $this;
    }
}