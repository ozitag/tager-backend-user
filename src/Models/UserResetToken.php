<?php

namespace OZiTAG\Tager\Backend\User\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserResetToken
 * @package OZiTAG\Tager\Backend\User\Models
 *
 * @property int $user_id
 * @property string $token
 * @property string $status
 * @property string $code
 *
 * @property User $user
 */
class UserResetToken extends Model
{
    protected $table = 'tager_users_reset_tokens';

    protected $fillable = [
        'user_id', 'token', 'status', 'code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
