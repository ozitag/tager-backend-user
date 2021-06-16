<?php

namespace OZiTAG\Tager\Backend\User\Events;

use Illuminate\Support\Facades\App;
use OZiTAG\Tager\Backend\User\Models\User;
use OZiTAG\Tager\Backend\User\Repositories\UserRepository;

class UserCreated
{
    protected int $user;

    protected ?string $password = null;

    public function __construct(int $userId, ?string $password = null)
    {
        $this->userId = $userId;

        $this->password = $password;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getUser(): ?User
    {
        return (App::make(UserRepository::class))->find($this->getUserId());
    }
}
