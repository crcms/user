<?php

namespace CrCms\User\Services\Verification;

use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Models\UserVerificationModel;

class ResetPasswordVerification extends AbstractVerification
{

    public function validate(): bool
    {
        $userVerification = $this->userVerification($this->request->input('id'));

        $this->setUserVerification($userVerification);

        if ($this->checkExpired()) {
            $this->setErrorUpdate();
            $this->throwError([
                'id' => [trans('user::app.verify_mail.timeout')],
            ]);
        }

        if ($this->checkCode()) {
            $this->setErrorUpdate();

            $this->throwError([
                'id' => [trans('user::app.verify_mail.timeout')],
            ]);
        }
    }

    /**
     * @return bool
     */
    protected function checkCode(): bool
    {
        return $this->userVerification->ext !== $this->request->input('code');
    }

    protected function validator(array $data): \Illuminate\Validation\Validator
    {
    }

    /**
     * @param int $userId
     * @param int $type
     * @param null|string $ext
     * @return UserVerificationModel
     */
    public function create(int $userId, int $type, ?string $ext = null): UserVerificationModel
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