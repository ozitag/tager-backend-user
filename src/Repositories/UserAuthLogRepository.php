<?php

namespace OZiTAG\Tager\Backend\User\Repositories;

use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;
use OZiTAG\Tager\Backend\User\Models\UserAuthLog;

class UserAuthLogRepository extends EloquentRepository
{
    public function __construct(UserAuthLog $model)
    {
        parent::__construct($model);
    }
}
