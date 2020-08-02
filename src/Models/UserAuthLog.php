<?php

namespace OZiTAG\Tager\Backend\User\Models;

use Illuminate\Database\Eloquent\Model;

class UserAuthLog extends Model
{
    protected $table = 'tager_users_auth_logs';

    protected $fillable = [
        'ip',
        'user_id'
    ];

    protected function user() {
        return $this->belongsTo(User::class);
    }
}
