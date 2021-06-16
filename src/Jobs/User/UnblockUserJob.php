<?php

namespace OZiTAG\Tager\Backend\User\Jobs\User;

use Illuminate\Support\Facades\Hash;
use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\User\Events\UserBlocked;
use OZiTAG\Tager\Backend\User\Events\UserCreated;
use OZiTAG\Tager\Backend\User\Events\UserUnblocked;
use OZiTAG\Tager\Backend\User\Exceptions\UserEmailBusyException;
use OZiTAG\Tager\Backend\User\Models\User;
use OZiTAG\Tager\Backend\User\Repositories\UserRepository;
use OZiTAG\Tager\Backend\User\Repositories\UserResetTokenRepository;
use OZiTAG\Tager\Backend\User\Requests\PasswordRestore\CheckRestoreTokenRequest;

class UnblockUserJob extends Job
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(UserRepository $repository)
    {
        if ($this->user->blocked == false) return $this->user;

        $model = $repository->set($this->user)->fillAndSave([
            'blocked' => false
        ]);

        event(new UserUnblocked($model->id));

        return $model;
    }

}
