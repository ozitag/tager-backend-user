<?php

namespace OZiTAG\Tager\Backend\User\Jobs\User;

use Illuminate\Support\Facades\Hash;
use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\User\Repositories\UserRepository;
use OZiTAG\Tager\Backend\User\Repositories\UserResetTokenRepository;
use OZiTAG\Tager\Backend\User\Requests\PasswordRestore\CheckRestoreTokenRequest;

class UpdateUserPasswordJob extends Job
{
    protected string $password;
    protected int $userId;

    /**
     * UpdateUserPasswordJob constructor.
     * @param string $password
     * @param int $user_id
     */
    public function __construct(string $password, int $userId)
    {
        $this->password = $password;
        $this->userId = $userId;
    }

    /**
     * @param UserRepository $repository
     * @throws \Exception
     */
    public function handle(UserRepository $repository)
    {
        $user = $repository->setById($this->userId);

        if (!$user) {
            throw new \Exception('');
        }

        $repository->fillAndSave([
            'password' => Hash::make($this->password)
        ]);
    }

}
