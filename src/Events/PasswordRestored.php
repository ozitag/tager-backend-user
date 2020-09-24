<?php
namespace OZiTAG\Tager\Backend\User\Events;


use OZiTAG\Tager\Backend\User\Models\User;
use OZiTAG\Tager\Backend\User\Models\UserResetToken;

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
    public function getUserId(): int {
        return $this->userId;
    }
}
