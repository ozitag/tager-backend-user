<?php

namespace OZiTAG\Tager\Backend\User\Jobs\User;

use Illuminate\Support\Facades\Hash;
use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\User\Events\UserCreated;
use OZiTAG\Tager\Backend\User\Exceptions\UserEmailBusyException;
use OZiTAG\Tager\Backend\User\Models\User;
use OZiTAG\Tager\Backend\User\Repositories\UserRepository;
use OZiTAG\Tager\Backend\User\Repositories\UserResetTokenRepository;
use OZiTAG\Tager\Backend\User\Requests\PasswordRestore\CheckRestoreTokenRequest;

class UpdateUserEmailJob extends Job
{
    protected User $user;
    protected string $email;

    public function __construct(User $user, string $email)
    {
        $this->user = $user;

        $this->email = $email;
    }

    public function handle(UserRepository $repository)
    {
        $user = $repository->findByEmail($this->email, $this->user->id);
        if ($user) {
            throw new UserEmailBusyException();
        }

        $model = $repository->set($this->user)->fillAndSave([
            'email' => $this->email,
        ]);

        return $model;
    }

}
