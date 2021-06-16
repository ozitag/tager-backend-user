<?php

namespace OZiTAG\Tager\Backend\User\Events;

use Illuminate\Support\Facades\App;
use OZiTAG\Tager\Backend\User\Models\User;
use OZiTAG\Tager\Backend\User\Repositories\UserRepository;

class UserBlocked
{
    public int $user;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getUser(): ?User
    {
        return (App::make(UserRepository::class))->find($this->getUserId());
    }
}
