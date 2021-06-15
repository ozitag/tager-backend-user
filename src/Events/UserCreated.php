<?php

namespace OZiTAG\Tager\Backend\User\Events;

class UserCreated
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
}
