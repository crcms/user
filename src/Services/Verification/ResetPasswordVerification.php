<?php

namespace CrCms\User\Services\Verification;

use CrCms\Repository\Exceptions\ResourceNotFoundException;
use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Models\UserVerificationModel;
use CrCms\User\Services\Verification\Contracts\Verification as VerificationContract;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ResetPasswordVerification extends AbstractVerification implements VerificationContract
{
    /**
     * @return bool
     */
    public function validate(): bool
    {
        try {
            $userVerification = $this->userVerification(
                $this->request->input('user_id'),
                $this->request->input('code')
            );
        } catch (ResourceNotFoundException $exception) {
            $this->setErrorUpdate();
            $this->throwVerifyError();
        }

        $this->setUserVerification($userVerification);

        if ($this->checkExpired()) {
            $this->setErrorUpdate();
        }

        return true;
    }

    /**
     * @throws UnprocessableEntityHttpException
     */
    protected function throwVerifyError()
    {
        throw new UnprocessableEntityHttpException(trans('user::app.verify_error'));
    }

    /**
     * @return bool
     */
    protected function checkCode(): bool
    {
        return $this->userVerification->ext !== $this->request->input('code');
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
}