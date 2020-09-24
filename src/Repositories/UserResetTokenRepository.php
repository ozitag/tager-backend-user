<?php

namespace OZiTAG\Tager\Backend\User\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;
use OZiTAG\Tager\Backend\User\Enums\PasswordRestoreTokenStatuses;
use OZiTAG\Tager\Backend\User\Enums\TokenStatuses;
use OZiTAG\Tager\Backend\User\Models\User;
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
    public function markExpiredByUserId(int $userId) {
        return $this->model
            ->whereStatus(PasswordRestoreTokenStatuses::CREATED)
            ->whereUserId($userId)
            ->update([
                'status' => PasswordRestoreTokenStatuses::EXPIRED
            ]);
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function findToken(string $token) {
        return $this->model
            ->whereToken($token)
            ->first();
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function revoke() {
        return $this->model
            ->update([
                'status' => PasswordRestoreTokenStatuses::SUCCESS
            ]);
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function findActiveToken(string $token) {
        return $this->model
            ->whereStatus(PasswordRestoreTokenStatuses::CREATED)
            ->whereToken($token)
            ->first();
    }

    /**
     * @param string $date
     * @return mixed
     */
    public function markOutdatedAsExpired(string $date) {
        return $this->model
            ->whereStatus(PasswordRestoreTokenStatuses::CREATED)
            ->where('created_at', '<', $date)
            ->update([
                'status' => PasswordRestoreTokenStatuses::EXPIRED
            ]);
    }
}
