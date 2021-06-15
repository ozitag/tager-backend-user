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

    public function findByEmail(string $email, ?int $excludeId = null): ?User
    {
        $query = $this->model->whereEmail($email);

        if ($excludeId) {
            $query->where('id', '<>', $excludeId);
        }

        return $query->first();
    }
}
