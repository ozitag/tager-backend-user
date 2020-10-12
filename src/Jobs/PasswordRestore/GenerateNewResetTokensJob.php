<?php

namespace OZiTAG\Tager\Backend\User\Jobs\PasswordRestore;

use Illuminate\Support\Str;
use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\User\Repositories\UserResetTokenRepository;

class GenerateNewResetTokensJob extends Job
{
    protected int $userId;

    /**
     * RevokeUserResetTokensJob constructor.
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param UserResetTokenRepository $repository
     */
    public function handle(UserResetTokenRepository $repository)
    {
        return $repository->fillAndSave([
            'user_id' => $this->userId,
            'token' => Str::orderedUuid()
        ]);
    }
}
