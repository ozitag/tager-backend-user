<?php

namespace OZiTAG\Tager\Backend\User\Events;

class PasswordRestoreRequested
{
    public int $userId;
    public string $userEmail;
    public string $token;

    /**
     * PasswordRestoreRequested constructor.
     * @param int $userId
     * @param string $userEmail
     * @param string $token
     */
    public function __construct(int $userId, string $userEmail, string $token)
    {
        $this->userId = $userId;
        $this->userEmail = $userEmail;
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getToken(): string {
        return $this->token;
    }

    /**
     * @return int
     */
    public function getUserId(): int {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getUserEmail(): string {
        return $this->userEmail;
    }
}
