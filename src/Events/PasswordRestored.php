<?php

namespace OZiTAG\Tager\Backend\User\Events;

class PasswordRestored
{
    public int $user;

    /**
     * PasswordRestored constructor.
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}
