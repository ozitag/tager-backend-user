<?php

namespace OZiTAG\Tager\Backend\User\Operations;

use OZiTAG\Tager\Backend\Core\Jobs\Operation;
use OZiTAG\Tager\Backend\User\Events\PasswordRestoreRequested;
use OZiTAG\Tager\Backend\User\Jobs\PasswordRestore\GenerateNewResetTokensJob;
use OZiTAG\Tager\Backend\User\Jobs\PasswordRestore\RevokeUserResetTokensJob;
use OZiTAG\Tager\Backend\User\Models\User;
use OZiTAG\Tager\Backend\User\Repositories\UserResetTokenRepository;


class RestoreTokenOperation extends Operation
{
    protected ?User $user;

    /**
     * RevokeUserResetTokensJob constructor.
     * @param User|null $user
     */
    public function __construct(?User $user = null)
    {
        $this->user = $user;
    }

    public function handle()
    {
        if (!$this->user) {
            return null;
        }

        $this->run(RevokeUserResetTokensJob::class, [
            'userId' => $this->user->id
        ]);

        $token = $this->run(GenerateNewResetTokensJob::class, [
            'userId' => $this->user->id
        ]);

        event(new PasswordRestoreRequested(
            $this->user->id, $this->user->email, 
            $token->token, $token->code
        ));

        return $token;
    }
}
