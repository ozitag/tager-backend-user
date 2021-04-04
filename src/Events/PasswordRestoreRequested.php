<?php

namespace OZiTAG\Tager\Backend\User\Events;

class PasswordRestoreRequested
{
    public int $userId;
    public string $userEmail;
    public string $token;
    public ?string $code;

    public function __construct(int $userId, string $userEmail, string $token, ?string $code = null)
    {
        $this->userId = $userId;
        $this->userEmail = $userEmail;
        $this->token = $token;
        $this->code = $code;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getUserEmail(): string
    {
        return $this->userEmail;
    }
}
