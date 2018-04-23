<?php

namespace CrCms\User\Services\Passwords;

use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Repositories\UserVerificationRepository;
use CrCms\User\Services\Verification\Contracts\Verification;
use CrCms\User\Services\Verification\Contracts\VerificationCode;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Exception;

class DatabaseTokenRepository implements TokenRepositoryInterface
{
    /**
     * The database connection instance.
     *
     * @var \Illuminate\Database\ConnectionInterface
     */
    protected $connection;

    /**
     * The Hasher implementation.
     *
     * @var \Illuminate\Contracts\Hashing\Hasher
     */
    protected $hasher;

    /**
     * The token database table.
     *
     * @var string
     */
    protected $table;

    /**
     * The hashing key.
     *
     * @var string
     */
    protected $hashKey;

    /**
     * The number of seconds a token should last.
     *
     * @var int
     */
    protected $expires;

    /**
     * @var Verification
     */
    protected $verification;

    /**
     * @var VerificationCode
     */
    protected $verificationCode;

    /**
     * Create a new token repository instance.
     *
     * @param  \Illuminate\Database\ConnectionInterface $connection
     * @param  \Illuminate\Contracts\Hashing\Hasher $hasher
     * @param  string $table
     * @param  string $hashKey
     * @param  int $expires
     * @return void
     */
    public function __construct(ConnectionInterface $connection, Verification $verification, VerificationCode $verificationCode,
                                $table, $expires = 60)
    {
        $this->table = $table;
        $this->expires = $expires * 60;
        $this->connection = $connection;
        $this->verification = $verification;
        $this->verificationCode = $verificationCode;
    }

    /**
     * Create a new token record.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword $user
     * @return string
     */
    public function create(CanResetPasswordContract $user)
    {
        $token = $this->verificationCode->generate();

        $this->verification->create($user->id, UserAttribute::VERIFY_MAIL, $token);

        return $token;
    }

    /**
     * Determine if a token record exists and is valid.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword $user
     * @param  string $token
     * @return bool
     */
    public function exists(CanResetPasswordContract $user, $token)
    {
        try {
            return $this->verification->validate($user->id, $token);
        } catch (Exception $exception) {
            return false;
        }
    }

    /**
     * Delete a token record by user.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword $user
     * @return void
     */
    public function delete(CanResetPasswordContract $user)
    {
    }

    /**
     * Delete expired tokens.
     *
     * @return void
     */
    public function deleteExpired()
    {
    }

    /**
     * Create a new token for the user.
     *
     * @return string
     */
    public function createNewToken()
    {
    }

    /**
     * Get the database connection instance.
     *
     * @return \Illuminate\Database\ConnectionInterface
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Begin a new database query against the table.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function getTable()
    {
        return $this->connection->table($this->table);
    }
}
