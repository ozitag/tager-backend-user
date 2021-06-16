<?php

namespace OZiTAG\Tager\Backend\User\Jobs\User;

use Illuminate\Support\Facades\Hash;
use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\User\Events\UserCreated;
use OZiTAG\Tager\Backend\User\Exceptions\UserEmailBusyException;
use OZiTAG\Tager\Backend\User\Repositories\UserRepository;
use OZiTAG\Tager\Backend\User\Repositories\UserResetTokenRepository;
use OZiTAG\Tager\Backend\User\Requests\PasswordRestore\CheckRestoreTokenRequest;

class CreateUserJob extends Job
{
    protected string $email;
    protected string $password;
    protected ?string $name = null;
    protected ?int $role = null;

    public function __construct(string $email, string $password, ?string $name = null, ?int $role = 1)
    {
        $this->email = $email;

        $this->password = $password;

        $this->name = $name;

        $this->role = $role;
    }

    public function handle(UserRepository $repository)
    {
        $user = $repository->findByEmail($this->email);
        if ($user) {
            throw new UserEmailBusyException();
        }

        $model = $repository->fillAndSave([
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'name' => $this->name,
            'role_id' => $this->role
        ]);

        event(new UserCreated($model->id, $this->password));

        return $model;
    }

}
