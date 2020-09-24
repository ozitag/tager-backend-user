<?php

namespace OZiTAG\Tager\Backend\User\Repositories;

use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;
use OZiTAG\Tager\Backend\User\Models\User;

class UserRepository extends EloquentRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User {
        return $this->model
            ->whereEmail($email)
            ->first();
    }
}
