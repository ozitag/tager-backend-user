<?php

namespace OZiTAG\Tager\Backend\User\Operations;

use OZiTAG\Tager\Backend\Core\Jobs\Operation;
use OZiTAG\Tager\Backend\User\Events\PasswordRestored;
use OZiTAG\Tager\Backend\User\Jobs\User\UpdateUserPasswordJob;
use OZiTAG\Tager\Backend\User\Models\UserResetToken;
use OZiTAG\Tager\Backend\User\Repositories\UserResetTokenRepository;


class RestoreUserPasswordOperation extends Operation
{
    protected UserResetToken $token;
    protected string $password;

    /**
     * RestoreUserPasswordOperation constructor.
     * @param UserResetToken $token
     * @param string $password
     */
    public function __construct(UserResetToken $token, string $password)
    {
        $this->token = $token;
        $this->password = $password;
    }

    /**
     * @param UserResetTokenRepository $repository
     */
    public function handle(UserResetTokenRepository $repository)
    {
        $repository->set($this->token);
        $repository->revoke();

        $this->run(UpdateUserPasswordJob::class, [
            'userId' => $this->token->user_id,
            'password' => $this->password
        ]);

        event(new PasswordRestored($this->token->user_id));
    }
}
