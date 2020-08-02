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
}
