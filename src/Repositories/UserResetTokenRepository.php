<?php

namespace OZiTAG\Tager\Backend\User\Repositories;

use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;
use OZiTAG\Tager\Backend\User\Enums\PasswordRestoreTokenStatuses;
use OZiTAG\Tager\Backend\User\Models\UserResetToken;

class UserResetTokenRepository extends EloquentRepository
{
    public function __construct(UserResetToken $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function markExpiredByUserId(int $userId)
    {
        return $this->model->whereStatus(PasswordRestoreTokenStatuses::CREATED->value)
            ->whereUserId($userId)
            ->update([
                'status' => PasswordRestoreTokenStatuses::EXPIRED->value
            ]);
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function findToken(string $token)
    {
        return $this->model
            ->whereToken($token)
            ->first();
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function revoke()
    {
        return $this->model->update([
            'status' => PasswordRestoreTokenStatuses::SUCCESS->value
        ]);
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function findActiveToken(string $token)
    {
        return $this->model
            ->whereStatus(PasswordRestoreTokenStatuses::CREATED->value)
            ->whereToken($token)
            ->first();
    }

    /**
     * @param string $date
     * @return mixed
     */
    public function markOutdatedAsExpired(string $date)
    {
        return $this->model
            ->whereStatus(PasswordRestoreTokenStatuses::CREATED->value)
            ->where('created_at', '<', $date)
            ->update([
                'status' => PasswordRestoreTokenStatuses::EXPIRED->value
            ]);
    }
}
