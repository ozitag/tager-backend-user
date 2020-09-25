<?php

namespace OZiTAG\Tager\Backend\User\Events;

use OZiTAG\Tager\Backend\User\Models\User;
use OZiTAG\Tager\Backend\User\Models\UserResetToken;

class PasswordRestoreRequested
{
    public User $user;
    public UserResetToken $token;

    /**
     * PasswordRestoreRequested constructor.
     * @param User $user
     * @param UserResetToken $token
     */
    public function __construct(User $user, UserResetToken $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * @return UserResetToken
     */
    public function getToken(): UserResetToken {
        return $this->token->refresh();
    }

    /**
     * @return int
     */
    public function getUserId(): int {
        return $this->user->id;
    }

    /**
     * @return User
     */
    public function getUser(): User {
        return $this->user;
    }
}
